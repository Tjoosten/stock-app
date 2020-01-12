@extends ('layouts.admin', ['title' => 'Account instellingen'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Mijn account</h1>
            <div class="page-subtitle">Beveiligings informatie</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include('account.settings.partials._sidenav')
            </div>

            <div class="col-9">
                <form action="{{ route('account.security.update') }}" method="POST" class="border-0 shadow-sm card">
                    @csrf
                    @method ('PATCH')

                    <div class="card-body">
                        <h6 class="border-bottom border-gray pb-1 mb-3">Beveiligings instellingen</h6>
                        @include('flash::message')

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="current">Huidig wachtwoord <span class="text-danger">*</span></label>
                                <input type="password" id="current" placeholder="Uw huidig wachtwoord" class="form-control @error('current_password', 'is-invalid')" @input('current_password')>
                                @error('current_password')
                            </div>

                            <div class="form-group col-6 mb-0">
                                <label for="password">Nieuw wachtwoord <span class="text-danger">*</span></label>
                                <input type="password" id="password" class="form-control @error('password', 'is-invalid')" placeholder="Uw nieuw wachtwoord" @input('password')>
                                @error('password')
                            </div>

                            <div class="form-group col-6 mb-0">
                                <label for="confirmation">Hehaal nieuw wachtwoord <span class="text-danger">*</span></label>
                                <input type="password" id="confirmation" class="form-control" placeholder="Herhaal uw nieuw wachtwoord" @input('password_confirmation')>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-top-0">
                        <button type="submit" class="btn btn-secondary">Aanpassen</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
