<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserStoreRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Services\UserService;

class UserApiController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *      path="/api/user",
     *      operationId="store",
     *      tags={"Users"},
     *      summary="Crea un usuario nuevo.",
     *      description="Crea un usuario nuevo.",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *      ),
     *
     *     @OA\Parameter(
     *          name="name",
     *          description="Nombre",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="email"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="password",
     *          description="Contraseña",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *     @OA\Parameter(
     *          name="password_confirmation",
     *          description="Confirmación de contraseña",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *
     *      @OA\Response(
     *          response=200,
     *          description="Operación realizada con éxito"
     *      ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Las credenciales no coinciden con nuestros registros",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(
     *                  property="validationMessages",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="email", type="string", example="admin@example.org"),
     *                          @OA\Property(
     *                              property="message",
     *                              type="string",
     *                              example="Las credenciales no coinciden con nuestros registros"
     *                          ),
     *                      )
     *                  ),
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error en el servidor",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(
     *                  property="validationMessages",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                  ),
     *              ),
     *          )
     *      ),
     * )
     *
     * Guarda un nuevo usuario
     */
    public function store(UserStoreRequest $request)
    {
        $this->userService->store($request->all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * @OA\Put(
     *      path="/api/user/{id}",
     *      operationId="update",
     *      tags={"Users"},
     *      summary="Actualiza un usuario existente.",
     *      description="Actualiza un usuario existente.",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *      ),
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Id usuario",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *     @OA\Parameter(
     *          name="name",
     *          description="Nombre",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="email"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          name="password",
     *          description="Contraseña",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *     @OA\Parameter(
     *          name="password_confirmation",
     *          description="Confirmación de contraseña",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *
     *      @OA\Response(
     *          response=200,
     *          description="Operación realizada con éxito"
     *      ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Las credenciales no coinciden con nuestros registros",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(
     *                  property="validationMessages",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="email", type="string", example="admin@example.org"),
     *                          @OA\Property(
     *                              property="message",
     *                              type="string",
     *                              example="Las credenciales no coinciden con nuestros registros"
     *                          ),
     *                      )
     *                  ),
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error en el servidor",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(
     *                  property="validationMessages",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                  ),
     *              ),
     *          )
     *      ),
     * )
     *
     * Actualiza un usuario existente
     */
    public function update(UserUpdateRequest $request, User $user) {
        return $this->userService->update($request->all(), $user);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
