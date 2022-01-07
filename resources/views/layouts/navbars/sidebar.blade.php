<div class="sidebar">
    <div class="sidebar-wrapper">
  @if(\Illuminate\Support\Facades\Auth::user()->type=='beta')
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Boost Terminal') }}</a>
        </div>
        <ul class="nav">
            <li @if (isset($pageSlug) && $pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('users') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if (isset($pageSlug) && $pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Client Management') }}</p>
                            </a>
                        </li>
                        <li @if (isset($pageSlug) && $pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Merchant Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#admin-settings" aria-expanded="true">
                    <i class="tim-icons icon-atom" ></i>
                    <span class="nav-link-text" >{{ __('Admin Settings') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="admin-settings">
                    <ul class="nav pl-4">
                        <li @if (isset($pageSlug) && $pageSlug == 'fundinghome') class="active " @endif>
                            <a href="{{ route('fundingHomeView')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Fundings / Receiving') }}</p>
                            </a>
                        </li>
                        <li @if (isset($pageSlug) && $pageSlug == 'routinghome') class="active " @endif>
                            <a href="{{ route('routingHomeView')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Routing Nodes') }}</p>
                            </a>
                        </li>
                         <li @if (isset($pageSlug) && $pageSlug == 'adminInfo') class="active " @endif>
                            <a href="{{ route('showAdminInfo') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Admin Info') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'transactions') class="active " @endif>
                <a href="{{ route('getTransactions') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>{{ __('Transactions') }}</p>
                </a>
            </li>
            
            
            
           
    </ul>
     @endif

  @if(\Illuminate\Support\Facades\Auth::user()->type == 'alpha')
         <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('C Light Alpha') }}</a>
        </div>
        <ul class="nav">
            <li @if (isset($pageSlug) && $pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'transactions alpha') class="active " @endif>
                <a href="{{ route('getTransactionsalpha') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>{{ __('Transactions') }}</p>
                </a>
            </li>
        </ul>
  @endif
    
    </div>
</div>
