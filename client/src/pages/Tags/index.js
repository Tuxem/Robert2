import store from '@/store';
import Alert from '@/components/Alert';
import Help from '@/components/Help/Help.vue';

export default {
  name: 'Tags',
  components: { Help },
  data() {
    return {
      help: 'page-tags.help',
      error: null,
      isLoading: false,
      validationError: null,
      isDisplayTrashed: false,
      isTrashDisplayed: false,
      deletedTags: [],
    };
  },
  computed: {
    tags() {
      return store.state.tags.list;
    },

    isFetched() {
      return store.state.tags.isFetched;
    },
  },
  mounted() {
    store.dispatch('tags/fetch');
  },
  methods: {
    isProtected(tagName) {
      return store.getters['tags/isProtected'](tagName);
    },

    addTag() {
      Alert.Prompt(
        this.$t,
        this.$t('page-tags.prompt-add'),
        'page-tags.tag-name',
        'page-tags.create',
      ).then(({ value: name }) => {
        if (name) {
          this.save(null, name);
        }
      });
    },

    edit(tagId, oldName) {
      Alert.Prompt(
        this.$t,
        this.$t('page-tags.prompt-modify'),
        oldName,
        'save',
        oldName,
      ).then(({ value: newName }) => {
        if (newName) {
          this.save(tagId, newName);
        }
      });
    },

    save(id, name) {
      const { resource } = this.$route.meta;
      let request = this.$http.post;
      let route = resource;
      if (id) {
        request = this.$http.put;
        route = `${resource}/${id}`;
      }

      this.resetHelpLoading();

      request(route, { name })
        .then(() => {
          this.help = { type: 'success', text: 'page-tags.saved' };
          this.isLoading = false;
          store.dispatch('tags/refresh');
        }).catch(this.displayError);
    },

    remove(id) {
      const isSoft = !this.isTrashDisplayed;
      Alert.ConfirmDelete(this.$t, 'tags', isSoft)
        .then((result) => {
          if (!result.value) {
            return;
          }

          this.resetHelpLoading();

          this.$http.delete(`tags/${id}`)
            .then(() => {
              this.help = { type: 'success', text: 'page-tags.deleted' };
              this.isLoading = false;
              if (this.isTrashDisplayed) {
                this.fetchDeleted();
              } else {
                store.dispatch('tags/refresh');
              }
            })
            .catch(this.displayError);
        });
    },

    restore(id) {
      Alert.ConfirmRestore(this.$t, 'tags')
        .then((result) => {
          if (!result.value) {
            return;
          }

          this.resetHelpLoading();

          this.$http.put(`${this.$route.meta.resource}/restore/${id}`)
            .then(() => {
              this.fetchDeleted();
              store.dispatch('tags/refresh');
            })
            .catch(this.showError);
        });
    },

    showTrashed() {
      this.isDisplayTrashed = !this.isDisplayTrashed;
      if (this.isDisplayTrashed) {
        this.fetchDeleted();
      } else {
        store.dispatch('tags/refresh');
        this.isTrashDisplayed = false;
      }
    },

    fetchDeleted() {
      this.resetHelpLoading();

      const params = { deleted: true };
      this.$http
        .get(this.$route.meta.resource, { params })
        .then(({ data }) => {
          this.deletedTags = data.data;
          this.isLoading = false;
        })
        .catch(this.displayError)
        .finally(() => {
          this.isTrashDisplayed = this.isDisplayTrashed;
        });
    },

    resetHelpLoading() {
      this.help = 'page-tags.help';
      this.error = null;
      this.isLoading = true;
      this.validationError = null;
    },

    displayError(error) {
      this.help = 'page-tags.help';
      this.isLoading = false;
      this.error = error;
      this.validationError = null;

      const { code, details } = error.response?.data?.error || { code: 0, details: {} };
      if (code === 400 && details.name) {
        [this.validationError] = details.name;
      }
    },
  },
};
