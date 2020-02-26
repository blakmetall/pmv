<div class="container app-container">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('users.search') }}" action="get">
                <div class="row">
                    <div class="col-md-12 form-group mb-3 input-group">
                        <input class="form-control" placeholder="{{ __('Search').' '.__('Users') }}" type="text" name="s_data" value="{{ (isset($_GET['s_data'])) ? $_GET['s_data'] : '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="icon-regular i-Magnifi-Glass1"></i>
                            </button>
                        </div>
                        @if(isset($_GET['s_data']))
                            <div class="input-group-append">
                                <a href="{{ route('users') }}" class="btn btn-primary text-white">
                                    <i class="icon-regular i-Close"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
