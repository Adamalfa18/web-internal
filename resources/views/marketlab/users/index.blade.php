<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.marketlab.navbar />

        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card login-style">
                        <div class="card-header user-title-style">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Account Management</h5>
                                    <p class="mb-0 text-sm">Here you can manage users.</p>
                                </div>
                                <div class="col-6 text-end user-add-sytle">
                                    <a href="{{ route('acount.create') }}"
                                        class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2">
                                        <i class="bi bi-person-fill-add"></i> Add Member
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mt-3 mx-3" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mt-3 mx-3" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('acount.index') }}" class="mb-3 mt-3 d-flex gap-2 px-4">
                            <input type="text" name="name" class="form-control" placeholder="Search Name"
                                value="{{ request('name') }}">
                            <select name="role" class="form-control">
                                <option value="">All Roles</option>
                                @foreach ($rool as $role)
                                    <option value="{{ $role->id }}"
                                        {{ request('role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('acount.index') }}" class="btn btn-secondary">Reset</a>
                        </form>

                        <div class="table-responsive px-4">
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Name</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Role</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Creation Date</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->id }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset('storage/' . $user->logo) }}"
                                                        class="rounded-circle mr-2" alt="user"
                                                        style="height: 36px; width: 36px;">
                                                </div>
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->email }}
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->user_role->role }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->created_at }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="#" class="edit-user-btn" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                    data-role="{{ $user->user_role->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal">
                                                    <i class="bi bi-person-fill-gear"></i>
                                                </a>
                                                <a href="#" class="edit-password-btn m-2"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}" data-bs-toggle="modal"
                                                    data-bs-target="#editPasswordModal">
                                                    <i class="bi bi-person-fill-lock"></i>
                                                </a>
                                                @if (auth()->user()->user_role_id !== 2)
                                                    <form action="{{ route('acount.destroy', $user->id) }}"
                                                        method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btm-delet"
                                                            onclick="return confirm('Apakah anda yakin?')">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Edit User --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>ID</label>
                            <input type="text" class="form-control" id="editUserId" name="id" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="editUserName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="editUserEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select class="form-select" id="editUserRole" name="role" required>
                                @foreach ($rool as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Upload Photo</label>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Password --}}
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editPasswordForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editPasswordId" name="id">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="editPasswordName" name="name"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="editPasswordEmail" name="email"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label>New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="editPasswordUser" name="password"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#editPasswordUser");

        togglePassword.addEventListener("click", function() {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
            this.querySelector('i').classList.toggle("fa-eye");
            this.querySelector('i').classList.toggle("fa-eye-slash");
        });

        document.querySelectorAll('.edit-user-btn').forEach(function(button) {
            button.onclick = function() {
                let userId = this.dataset.id;
                let userName = this.dataset.name;
                let userEmail = this.dataset.email;
                let userRole = this.dataset.role;

                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserName').value = userName;
                document.getElementById('editUserEmail').value = userEmail;
                document.getElementById('editUserRole').value = userRole;

                document.getElementById('editUserForm').action = "/acount/" + userId;
            };
        });

        document.querySelectorAll('.edit-password-btn').forEach(function(button) {
            button.onclick = function() {
                let userId = this.dataset.id;
                let userName = this.dataset.name;
                let userEmail = this.dataset.email;

                document.getElementById('editPasswordId').value = userId;
                document.getElementById('editPasswordName').value = userName;
                document.getElementById('editPasswordEmail').value = userEmail;
                document.getElementById('editPasswordUser').value = '';

                document.getElementById('editPasswordForm').action = "/acount/reset-password/" + userId;
            };
        });
    </script>
</x-app-layout>
