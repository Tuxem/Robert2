<?php
declare(strict_types=1);

namespace Robert2\API;

class ApiRouter
{
    private $_routes = [
        'get' => [
            '/users[/]'                                => 'UserController:getAll',
            '/users/{id:[0-9]+}[/]'                    => 'UserController:getOne',
            '/users/{id:[0-9]+}/settings[/]'           => 'UserController:getSettings',
            '/tags[/]'                                 => 'TagController:getAll',
            '/tags/{id:[0-9]+}/persons[/]'             => 'TagController:getPersons',
            '/tags/{id:[0-9]+}/materials[/]'           => 'TagController:getMaterials',
            '/categories[/]'                           => 'CategoryController:getAll',
            '/categories/{id:[0-9]+}[/]'               => 'CategoryController:getOne',
            '/persons[/]'                              => 'PersonController:getAll',
            '/persons/{id:[0-9]+}[/]'                  => 'PersonController:getOne',
            '/persons/{id:[0-9]+}/tags[/]'             => 'PersonController:getTags',
            '/countries[/]'                            => 'CountryController:getAll',
            '/countries/{id:[0-9]+}[/]'                => 'CountryController:getOne',
            '/companies[/]'                            => 'CompanyController:getAll',
            '/companies/{id:[0-9]+}[/]'                => 'CompanyController:getOne',
            '/companies/{id:[0-9]+}/persons[/]'        => 'CompanyController:getPersons',
            '/parks[/]'                                => 'ParkController:getAll',
            '/parks/{id:[0-9]+}[/]'                    => 'ParkController:getOne',
            '/parks/{id:[0-9]+}/materials[/]'          => 'ParkController:getMaterials',
            '/materials[/]'                            => 'MaterialController:getAll',
            '/materials/{id:[0-9]+}[/]'                => 'MaterialController:getOne',
            '/materials/{id:[0-9]+}/tags[/]'           => 'MaterialController:getTags',
            '/materials/attributes[/]'                 => 'MaterialController:getAttributes',
            '/events[/]'                               => 'EventController:getAll',
            '/events/{id:[0-9]+}[/]'                   => 'EventController:getOne',
            '/events/{id:[0-9]+}/missing-materials[/]' => 'EventController:getMissingMaterials',
            '/bills/{id:[0-9]+}[/]'                    => 'BillController:getOne',
        ],
        'post' => [
            '/token[/]'                        => 'TokenController:auth',
            '/users/signin[/]'                 => 'TokenController:auth',
            '/users/signup[/]'                 => 'UserController:create',
            '/categories[/]'                   => 'CategoryController:create',
            '/subcategories[/]'                => 'SubCategoryController:create',
            '/tags[/]'                         => 'TagController:create',
            '/persons[/]'                      => 'PersonController:create',
            '/companies[/]'                    => 'CompanyController:create',
            '/parks[/]'                        => 'ParkController:create',
            '/materials[/]'                    => 'MaterialController:create',
            '/attributes[/]'                   => 'AttributeController:create',
            '/events[/]'                       => 'EventController:create',
            '/events/{eventId:[0-9]+}/bill[/]' => 'BillController:create',
        ],
        'put' => [
            '/users/{id:[0-9]+}[/]'                 => 'UserController:update',
            '/users/restore/{id:[0-9]+}[/]'         => 'UserController:restore',
            '/users/{id:[0-9]+}/settings[/]'        => 'UserController:updateSettings',
            '/categories/{id:[0-9]+}[/]'            => 'CategoryController:update',
            '/categories/restore/{id:[0-9]+}[/]'    => 'CategoryController:restore',
            '/subcategories/{id:[0-9]+}[/]'         => 'SubCategoryController:update',
            '/subcategories/restore/{id:[0-9]+}[/]' => 'SubCategoryController:restore',
            '/tags/{id:[0-9]+}[/]'                  => 'TagController:update',
            '/tags/restore/{id:[0-9]+}[/]'          => 'TagController:restore',
            '/persons/{id:[0-9]+}[/]'               => 'PersonController:update',
            '/persons/restore/{id:[0-9]+}[/]'       => 'PersonController:restore',
            '/companies/{id:[0-9]+}[/]'             => 'CompanyController:update',
            '/companies/restore/{id:[0-9]+}[/]'     => 'CompanyController:restore',
            '/parks/{id:[0-9]+}[/]'                 => 'ParkController:update',
            '/parks/restore/{id:[0-9]+}[/]'         => 'ParkController:restore',
            '/materials/{id:[0-9]+}[/]'             => 'MaterialController:update',
            '/materials/restore/{id:[0-9]+}[/]'     => 'MaterialController:restore',
            '/events/{id:[0-9]+}[/]'                => 'EventController:update',
            '/events/restore/{id:[0-9]+}[/]'        => 'EventController:restore',
        ],
        'delete' => [
            '/users/{id:[0-9]+}[/]'         => 'UserController:delete',
            '/categories/{id:[0-9]+}[/]'    => 'CategoryController:delete',
            '/subcategories/{id:[0-9]+}[/]' => 'SubCategoryController:delete',
            '/tags/{id:[0-9]+}[/]'          => 'TagController:delete',
            '/persons/{id:[0-9]+}[/]'       => 'PersonController:delete',
            '/companies/{id:[0-9]+}[/]'     => 'CompanyController:delete',
            '/parks/{id:[0-9]+}[/]'         => 'ParkController:delete',
            '/materials/{id:[0-9]+}[/]'     => 'MaterialController:delete',
            '/events/{id:[0-9]+}[/]'        => 'EventController:delete',
            '/bills/{id:[0-9]+}[/]'         => 'BillController:delete',
        ],
    ];

    public function getRoutes(): Array
    {
        return $this->_routes;
    }
}
