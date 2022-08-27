<?php

return [

    // Titles
    'showing-all-users'     => 'Mostrar Todos los Usuarios',
    'users-menu-alt'        => 'Mostrar Menú de Gestión de Usuarios',
    'create-new-user'       => 'Crear Nuevo Usuario',
    'show-deleted-users'    => 'Mostrar Usuario Eliminado',
    'editing-user'          => 'Editar Usuario :name',
    'showing-user'          => 'Mostrar Usuario :name',
    'showing-user-title'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Usuario creado con éxito! ',
    'updateSuccess'   => 'Usuario actualizado correctamente! ',
    'deleteSuccess'   => 'Usuario eliminado exitosamente! ',
    'deleteSelfError' => 'No puedes borrarte a ti mismo! ',

    // Show User Tab
    'viewProfile'            => 'Ver perfil',
    'editUser'               => 'Editar Usuario',
    'deleteUser'             => 'Eliminar Usuario',
    'usersBackBtn'           => 'Volver a los Usuarios',
    'usersPanelTitle'        => 'Informacion del Usuario',
    'labelUserName'          => 'Nombre de Usuario:',
    'labelEmail'             => 'Correo Electrónico:',
    'labelFirstName'         => 'Primer Nombre:',
    'labelLastName'          => 'Last Name:',
    'labelRole'              => 'Rol:',
    'labelStatus'            => 'Estado:',
    'labelAccessLevel'       => 'Acceso',
    'labelPermissions'       => 'Permisos:',
    'labelCreatedAt'         => 'Creado en:',
    'labelUpdatedAt'         => 'Actualizado en:',
    'labelIpEmail'           => 'IP de Registro de Correo Electrónico:',
    'labelIpEmail'           => 'IP de Registro de Correo Electrónico:',
    'labelIpConfirm'         => 'IP de confirmación:',
    'labelIpSocial'          => 'IP de Registro de Socialité:',
    'labelIpAdmin'           => 'IP de Registro de Administrador:',
    'labelIpUpdate'          => 'Última Actualización IP:',
    'labelDeletedAt'         => 'Eliminado el',
    'labelIpDeleted'         => 'IP Eliminada:',
    'usersDeletedPanelTitle' => 'Información de Usuario Eliminada',
    'usersBackDelBtn'        => 'Volver a Usuarios Eliminados',

    'successRestore'    => 'Usuario restaurado con éxito.',
    'successDestroy'    => 'Registro de usuario destruido con éxito.',
    'errorUserNotFound' => 'Usuario no encontrado.',

    'labelUserLevel'  => 'Nivel',
    'labelUserLevels' => 'Niveles',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'Nombre de Usuario',
        'fname'     => 'Nombre',
        'lname'     => 'Apellido',
        'email'     => 'Correo Electrónico',
        'role'      => 'Rol',
        'created'   => 'Creado',
        'updated'   => 'Actualizado',
        'actions'   => 'Acciones',
        'updated'   => 'Actualizado',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo Usuario',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Borrar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Ver</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Usuarios</span>',
        'back-to-user'  => 'Volver   <span class="hidden-xs">al usuario</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Eliminar</span><span class="hidden-xs"> User</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Editar</span><span class="hidden-xs"> User</span>',
    ],

    'tooltips' => [
        'delete'        => 'Borrar',
        'show'          => 'Ver',
        'edit'          => 'Editar',
        'create-new'    => 'Crear Nuevo Usuario',
        'back-users'    => 'Volver a los usuarios',
        'email-user'    => 'Correo Electrónico :user',
        'submit-search' => 'Enviar Búsqueda de Usuarios',
        'clear-search'  => 'Borrar Resultados de Búsqueda',
    ],

    'messages' => [
        'userNameTaken'          => 'Se toma el nombre de usuario',
        'userNameRequired'       => 'Se requiere nombre de usuario',
        'fNameRequired'          => 'Se requiere el nombre',
        'lNameRequired'          => 'Se requiere apellido',
        'emailRequired'          => 'Correo Electronico es requerido',
        'emailInvalid'           => 'Correo Electronico es inválido',
        'passwordRequired'       => 'Contraseña es requerida',
        'PasswordMin'            => 'La contraseña debe tener al menos 6 caracteres',
        'PasswordMax'            => 'La longitud máxima de la contraseña es de 20 caracteres',
        'captchaRequire'         => 'Captcha es requerido',
        'CaptchaWrong'           => 'Captcha incorrecto, inténtalo de nuevo.',
        'roleRequired'           => 'Se requiere rol de usuario.',
        'user-creation-success'  => 'Usuario creado con éxito!',
        'update-user-success'    => 'Usuario actualizado correctamente!',
        'delete-success'         => 'Eliminado con éxito el usuario!',
        'cannot-delete-yourself' => 'No puedes borrarte a ti mismo!',
    ],

    'show-user' => [
        'id'                => 'ID Usuario',
        'name'              => 'Nombre de Usuario',
        'email'             => '<span class="hidden-xs">Usuario </span>Email',
        'role'              => 'Rol del Usuario',
        'created'           => 'Creado <span class="hidden-xs">en</span>',
        'updated'           => 'Actualizado <span class="hidden-xs">en</span>',
        'labelRole'         => 'Rol del Usuario',
        'labelAccessLevel'  => '<span class="hidden-xs">Usuario</span> Nivel de Acceso|<span class="hidden-xs">Usuario</span> Niveles de Acceso',
    ],

    'search'  => [
        'title'             => 'Mostrar Resultados de Búsqueda',
        'found-footer'      => ' Registro(s) encontrado(s)',
        'no-results'        => 'No hay resultados',
        'search-users-ph'   => 'Buscar Usuarios',
    ],

    'modals' => [
        'delete_user_message' => '¿Estás seguro de que quieres eliminar? :user?',
    ],
];
