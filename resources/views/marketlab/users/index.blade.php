<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card login-style">
                        <div class="card-header user-title-style">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Acount Management</h5>
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
                        <div class="row justify-content-center">
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
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
                                                        class="rounded-circle mr-2" alt="user1"
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
                                                    data-email="{{ $user->email }}" password="{{ $user->password }}"
                                                    data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                                                    <i class="bi bi-person-fill-lock"></i>
                                                </a>
                                                @if (auth()->user()->user_role_id !== 2)
                                                    <form action="{{ route('acount.destroy', $user->id) }}"
                                                        method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btm-delet"
                                                            onclick="return confirm('Apakah anda yakin?')">
                                                            <i class="bi bi-trash-fill"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="editUserForm" action="{{ route('acount.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hidden ID Field -->
                        <div class="mb-3">
                            <label for="editPasswordName" class="form-label">Id User</label>
                            <input type="text" class="form-control" id="editUserId" name="id">
                        </div>

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="editUserName" name="name" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="editUserEmail" name="email" required>
                        </div>


                        <!-- Role Field -->
                        <div class="mb-3">
                            <label for="editUserRole" class="form-label">Role:</label>
                            <select class="form-select" id="editUserRole" name="role" required>
                                @foreach ($rool as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ganti bagian ini untuk menambahkan fitur upload gambar -->
                        <div class="mb-3">
                            <label for="editUserLogo" class="form-label">Upload Photo:</label>
                            <input type="file" class="form-control" id="editUserLogo" name="logo"
                                accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Password User -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="editPasswordForm" action="{{ route('acount.reset-password.reset', $user->id) }}"
                        method="POST">
                        @csrf

                        <!-- Hidden ID Field -->
                        <div class="mb-3">
                            <label for="editPasswordName" class="form-label">Id User</label>
                            <input type="text" class="form-control" id="editPasswordId" name="id"
                                value="{{ $user->id }}" readonly>
                        </div>
                        {{-- <input type="hidden" id="editPasswordId" name="id" value="{{ $user->id }}"> --}}

                        <!-- Name Field (Read-only) -->
                        <div class="mb-3">
                            <label for="editPasswordName" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="editPasswordName" name="name"
                                value="{{ $user->name }}" readonly>
                        </div>

                        <!-- Email Field (Read-only) -->
                        <div class="mb-3">
                            <label for="editPasswordEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="editPasswordEmail" name="email"
                                value="{{ $user->email }}" readonly>
                        </div>

                        {{-- Edit Password --}}
                        <div class="mb-3">
                            <label for="editPasswordUser" class="form-label">Ubah Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="editPasswordUser" name="password"
                                    required>
                                <button class="btn btn-pasword btn-outline-secondary" type="button"
                                    id="togglePassword" style="border: 1px solid #ced4da;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#editPasswordUser");

        togglePassword.addEventListener("click", function() {
            // Toggle the type attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle the eye icon
            this.querySelector('i').classList.toggle("fa-eye");
            this.querySelector('i').classList.toggle("fa-eye-slash");
        });

        document.querySelectorAll('.edit-user-btn').forEach(function(button) {
            button.onclick = function() {
                var userId = this.getAttribute('data-id');
                var userName = this.getAttribute('data-name');
                var userEmail = this.getAttribute('data-email');
                var userRole = this.getAttribute('data-role');

                // Set the values in the form
                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserName').value = userName;
                document.getElementById('editUserEmail').value = userEmail;
                document.getElementById('editUserRole').value = userRole;

                // Update the form action with the correct user ID
                document.getElementById('editUserForm').action = "/acount/" + userId;
            };
        });
        document.querySelectorAll('.edit-password-btn').forEach(function(button) {
            button.onclick = function() {
                var userId = this.getAttribute('data-id');
                var userName = this.getAttribute('data-name');
                var userEmail = this.getAttribute('data-email');
                var UserPasword = this.getAttribute('password');

                // Set the values in the form
                document.getElementById('editPasswordId').value = userId;
                document.getElementById('editPasswordName').value = userName;
                document.getElementById('editPasswordEmail').value = userEmail;
                document.getElementById('editPasswordUser').value = UserPasword;

                // Update the form action with the correct user ID
                document.getElementById('editPasswordForm').action = "/acount/reset-password/" + userId;
            };
        });
    </script>
</x-app-layout>
