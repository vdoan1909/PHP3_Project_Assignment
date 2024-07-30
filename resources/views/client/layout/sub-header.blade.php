<div class="section login-header">
    <div class="login-header-wrapper navbar navbar-expand">

        <div class="login-header-logo">
            <a href="{{ route('client.index') }}"><img src="{{ asset('theme/client/assets/images/logo-icon.png') }}"
                    alt="Logo"></a></li>
        </div>

        <div class="login-header-search dropdown">
            <div class="search-input dropdown-menu">
                <form action="{{ route('client.exams.index') }}" method="POST">
                    @csrf
                    @method('GET')
                    <input type="text" placeholder="Tìm kiếm" name="name" value="{{ old('name') }}">
                    <button type="submit" class="">
                        <i class="flaticon-loupe"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="login-header-action ml-auto">
            <a class="action author" href="{{ route('chatify') }}">
                <img src="https://inacademia.org/wp-content/uploads/2023/01/new-default-image-icon.png" alt="Author">
            </a>
        </div>
    </div>
</div>
