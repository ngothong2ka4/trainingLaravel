<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        // Lấy giá trị từ request
        $nameOrEmail = $request->input('name_email');
        $type = $request->input('type');

        // Bắt đầu xây dựng truy vấn dựa trên điều kiện từ form
        $usersQuery = User::query();

        // Kiểm tra và thêm điều kiện vào truy vấn
        if (!empty($nameOrEmail)) {
            $usersQuery->where(function ($query) use ($nameOrEmail) {
                $query->where('name', 'like', '%' . $nameOrEmail . '%')
                      ->orWhere('email', 'like', '%' . $nameOrEmail . '%');
            });
        }

        if (!empty($type)) {
            $usersQuery->where('type', $type);
        }

        // Thực hiện truy vấn để lấy danh sách người dùng
        $users = $usersQuery->latest('id')->paginate(5); // Thay đổi số lượng user the thay

        return view('users.index', [
            'users' => $users,
            'nameOrEmail' => $nameOrEmail, // Trả về lại giá trị đã tìm kiếm để điền lại vào form
            'type' => $type, // Trả về lại giá trị type để điền lại vào form
        ]);
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        
        // dd(array_merge($request->validated()) );
        $user->create(array_merge($request->validated(), [
            'password' => Hash::make($request->password),
        ]));

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */ 
    public function show(User $user) 
    {
        // dd($user);
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            // 'userRole' => $user->roles->pluck('name')->toArray(),
            // 'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
        // dd($request->all());
        $user->update($request->validated());


        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}