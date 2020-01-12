@extends ('layouts.admin', ['title' => 'Account instellingen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Mijn account</h1>
            <div class="page-subtitle">Algemene informatie</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include('account.settings.partials._sidenav')
            </div>

            <div class="col-9">
                <form action="" method="POST" class="card shadow-sm border-0">
                    @csrf
                    @method ('PATCH')
                    @form ($currentUser)

                    <div class="card-body">
                        <h6 class="border-bottom border-gray pb-1 mb-3">Algemene informatie</h6>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="naam">Naam <span class="text-danger">*</span></label>
                                <input type="text" id="naam" class="form-control @error('name', 'is-invalid')" placeholder="Uw naam" @input('name')>
                                @error('name')
                            </div>

                            <div class="form-group mb-0 col-12">
                                <label for="email">Email adres <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control @error('email', 'is-invalid')" placeholder="Uw email adres" @input('email')>
                                @error('email')
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-top-0">
                        <button type="submit" class="btn btn-secondary">Opslaan</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
