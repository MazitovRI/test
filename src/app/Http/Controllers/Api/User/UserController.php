<?php

namespace App\Http\Controllers\Api\User;

use App\Action\StoreAction;
use App\Action\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(Request $request) :JsonResponse
    {
        return $this->response(User::all());
    }

    /**
     * @param  UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request) :JsonResponse
    {
        //
        DB::beginTransaction();
        try {
            $user = new User();
            $request->password = Hash::make($request->password);
            if ((new StoreAction($request->toArray(), $user))->action()) {
                DB::commit();
                $user->refresh();
                return $this->response($user, 204, 'Пользователь успешно создан');
            }
            throw new Exception('Не удалось создать пользователя');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  User $user
     * @return JsonResponse
     */
    public function show(User $user) :JsonResponse
    {
        //
        return $this->response($user);
    }

    /**
     * @param  UserRequest  $request
     * @param  User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user) :JsonResponse
    {
        //
        DB::beginTransaction();
        try {
            if ((new UpdateAction($request->toArray(), $user))->action()) {
                DB::commit();
                return $this->response($user->refresh(), 204, 'Пользователь успешно обновлен');
            }
            throw new Exception('Не удалось обновить пользователя');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function destroy(User $user) :JsonResponse
    {
        //
        $user->delete();

        return $this->response(null, 204, 'Пользователь удален');
    }
}
