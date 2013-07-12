<?php namespace ACR\Auth;

use Illuminate\Auth\UserProviderInterface,
    Illuminate\Auth\GenericUser;

class ACRUserProvider implements UserProviderInterface
{
    /**
    * @var UserService
    */
    private $userService;

    public function __construct(\Funcionario $userService)
    {
        $this->userService = $userService;
    } 

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByID($identifier)
    {
        /** @var User $user  */
        $user = \Funcionario::find($identifier);

        if (!$user instanceof \Funcionario) {
            return false;
        }

        return new GenericUser([
            'id'       => $user->id,
            'username' => $user->usuario
        ]);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = \Funcionario::searchByUsername($credentials['email']);

        if (!$user instanceof \Funcionario) {
            return false;
        }

        return new GenericUser([
            'id'       => $user->id,
            'username' => $user->usuario
        ]);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Auth\UserInterface $user
     * @param  array  $credentials
     *
     * @return bool
     */
     public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
     {
        $validated = \Funcionario::authenticate($credentials['email'], $credentials['password']);

        $validated = $validated && $user->userName = $credentials['email'];

        return $validated;
     }
}