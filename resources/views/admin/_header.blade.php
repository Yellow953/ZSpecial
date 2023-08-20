<!-- header area start -->
<div class="header-area px-3 py-0">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-6 clearfix d-flex">
            <div class="mx-3 my-auto nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <form action="/dollar_rate/usage" method="post" class="d-none d-md-flex">
                @csrf
                <div class="input-group input-group-outline">
                    <div class="d-flex mx-4">
                        <button type="submit" class="btn bg-white d-flex">
                            <div class="my-auto mx-2">Dolar</div>
                            <!-- Rounded switch -->
                            <label class="switch my-auto">
                                <input type="checkbox" name="usage" {{(Helper::dollar_rate()->usage == true) ? 'checked'
                                : ''}}>
                                <span class="slider round"></span>
                            </label>
                            <div class="my-auto mx-2">LBP</div>
                        </button>

                        <div class="my-auto text-primary">
                            Dollar Rate: <span id="dollar_rate">{{Helper::dollar_rate()->usage == true ?
                                Helper::dollar_rate()->lbp . ' LBP' : '1 $'}}</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- profile info & task notification -->
        <div class="col-6 clearfix p-0">
            <div class="user-profile pull-right m-0 border">
                <img class="avatar user-thumb" src="{{asset('assets/images/default_profile.png')}}" alt="avatar">
                <h4 class="user-name dropdown-toggle text-dark" data-toggle="dropdown">{{ ucwords(Auth::user()->name)
                    }}<i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a href="/profile" class="dropdown-item">{{ ucfirst(Auth::user()->name) }}
                        ({{ucfirst(Auth::user()->role)}})</a>
                    <a class="dropdown-item" href="/password/edit">Change Password</a>
                    <a class="dropdown-item" href="/dollar_rate/edit">Change Dollar Rate</a>
                    <a class="dropdown-item" href="/logout"> {{
                        __('Logout') }}
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- header area end -->