<div class="container app-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('contractors') }}" action="get">

                <div class="row row-xs">
                    <div class="col-md-10">
                        <input 
                            class="form-control" 
                            placeholder="{{ __('Search...') }}" 
                            type="text" 
                            name="s" 
                            value="{{ (isset($_GET['s'])) ? $_GET['s'] : '' }}"/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark btn-icon mr-2" type="submit">
                            <span class="ul-btn__icon">
                                <i class="i-Magnifi-Glass1"></i>
                            </span>
                        </button>

                        @if(isset($_GET['s']))
                            <a href="{{ route('contractors') }}" class="btn btn-outline-dark btn-icon" role="button">
                                <span class="ul-btn__icon">
                                    <i class="i-Restore-Window"></i>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>