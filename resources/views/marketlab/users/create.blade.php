<!-- resources/views/clients/create.blade.php -->

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-app.marketlab.navbar />

        <div class="container-fluid py-4 px-5">

            <div class="row">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>
                @endif

                <div class="col-md-12">
                    <form method="post" action="{{ route('acount.store') }}" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="id" class="form-label">ID (Opsional)</label>
                                <input type="text" name="id"
                                    class="form-control @error('id') is-invalid @enderror" id="id"
                                    placeholder="Biarkan kosong untuk generate otomatis" value="{{ old('id') }}">
                                @error('id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Acount</label>
                                <input type="text" name="name"
                                    class="form-control  @error('name') is-invalid @enderror" id="name"
                                    placeholder="Acount" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control  @error('email') is-invalid @enderror" id="email"
                                    placeholder="Email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="user_role_id" class="form-label">Status Akun</label>
                                <select class="form-select" name="user_role_id">
                                    @foreach ($rool as $rool)
                                        @if (old('user_role_id') == $rool->id)
                                            <option value="{{ $rool->id }}" selected>{{ $rool->role }}</option>
                                        @else
                                            <option value="{{ $rool->id }}">{{ $rool->role }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control counded-buttom @error('password') is-invalid @enderror"
                                    id="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo Brand</label>
                                    <input type="file" class="form-control" name="logo" id="logo"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                        <a href="/dashboard/user_login" class="btn btn-success"> <span
                                data-feather="arrow-left"></span>Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Akun</button>
                    </form>
                </div>
            </div>
        </div>


    </main>

</x-app-layout>
