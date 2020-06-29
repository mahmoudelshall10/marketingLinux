<li class="nav-item start {{ active_link(null,'active open') }} ">
    <a href="{{aurl('')}}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">{{trans('admin.dashboard')}}</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('settings','active open')}}  ">
    <a href="{{aurl('settings')}}" class="nav-link nav-toggle">
        <i class="fa fa-cog"></i>
        <span class="title">{{trans('admin.settings')}}</span>
        <span class="selected"></span>
    </a>
</li>
<li class="nav-item start {{active_link('questions','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-question"></i>
        <span class="title">{{trans('admin.questions')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('questions','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}"> 
        <li class="nav-item start {{active_link('questions','active open')}}  "> 
            <a href="{{aurl('questions')}}" class="nav-link "> 
                <i class="fa fa-question"></i>
                <span class="title">{{trans('admin.questions')}}  </span>
                <span class="selected"></span>
            </a>
        </li> 
        <li class="nav-item start"> 
            <a href="{{ aurl('questions/create') }}" class="nav-link "> 
                <i class="fa fa-plus"></i> 
                <span class="title"> {{trans('admin.create')}}  </span> 
                <span class="selected"></span> 
            </a> 
        </li> 
    </ul> 
</li>

<li class="nav-item start {{request()->segment(2) === 'answers' ? 'active open' : ''}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-paper-plane"></i>
        <span class="title">{{trans('admin.answers')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('answers','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}"> 
        <li class="nav-item start  {{request()->segment(2) === 'answers' ? 'active open' : ''}} "> 
            <a href="{{aurl('answers')}}" class="nav-link "> 
                <i class="fa fa-paper-plane"></i>
                <span class="title">{{trans('admin.answers')}}  </span>
                <span class="selected"></span>
            </a>
        </li> 
        <li class="nav-item start"> 
            <a href="{{ aurl('answers/create') }}" class="nav-link "> 
                <i class="fa fa-plus"></i> 
                <span class="title"> {{trans('admin.create')}}  </span> 
                <span class="selected"></span> 
            </a> 
        </li> 
    </ul> 
</li>
<li class="nav-item start {{active_link('aiqs','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user"></i>
        <span class="title">{{trans('admin.aiqs')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('aiqs','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}"> 
        <li class="nav-item start {{active_link('aiqs','active open')}}  "> 
            <a href="{{aurl('aiqs')}}" class="nav-link "> 
                <i class="fa fa-user"></i>
                <span class="title">{{trans('admin.aiqs')}}  </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul> 
</li>
<li class="nav-item start {{active_link('users','active open')}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">{{trans('admin.users')}} </span>
        <span class="selected"></span>
        <span class="arrow {{active_link('users','open')}}"></span>
    </a>
    <ul class="sub-menu" style="{{active_link('','block')}}"> 
        <li class="nav-item start {{active_link('users','active open')}}  "> 
            <a href="{{aurl('users')}}" class="nav-link "> 
                <i class="fa fa-users"></i>
                <span class="title">{{trans('admin.users')}}  </span>
                <span class="selected"></span>
            </a>
        </li> 
    </ul> 
</li>