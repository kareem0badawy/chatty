<style>
  #imgchat{
    margin-left: 20px;
    position: fixed;
  }
</style>
<nav class="navbar navbar-default" role="navigation"> 
      <div class="col-lg-1">
          <img id="imgchat" src="{{asset('icon/chat.png')}}">  
      </div> 
      <div class="container">            
          <div  class="navbar-header">
              <a  class="navbar-brand" href="{{route('home')}}">chatty</a>
          </div>
        <div class="collapse navbar-collapse">
           @if(Auth::check()) 
                <ul class="nav navbar-nav">
                  <li><a href="#">Timeline</a></li>
                  <li><a href="#">Friends</a></li>
                </ul>

                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                      <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
             @endif
          <ul class="nav navbar-nav navbar-right">
           @if(Auth::check()) 
                <li>
                    <a href="{{ route('profile.index',['username'=>Auth::user()->username]) }}">        {{ Auth::user()->getNameOrUsername() }}
                    </a>
                </li>
                <li><a href="{{ route('profile.edit') }}">Update profile</a></li>
                <li><a href="{{ route('auth.signout') }}">
                    <span class="label label-danger">Sign out</span>
                </a>
                </li>
             @else 
                <li>
                  <a href="{{ route('auth.signup') }}">
                     <span class="label label-info">Sign up</span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('auth.signin') }}">
                      <span class="label label-success">Sign in</span>
                  </a>
                </li>
             @endif 
          </ul>
        </div>
      </div>
    </nav>

