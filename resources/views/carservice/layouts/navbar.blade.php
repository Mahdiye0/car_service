<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active p-1">
          <a class="nav-link" href="{{ route('car-service.home') }}">صفحه نخست <span class="sr-only">(current) </span></a>
        </li>


        <li class="nav-item p-1">
            <a class="nav-link" href="{{ route('car-service.contact-us') }}">ارتباط با ما</a>
          </li>
        @auth
          @switch($type)
              @case(1)
              <li class="nav-item p-1  ">
                <a class="nav-link" href="{{ route('car-service.service.reportservice',auth()->user()->id) }}"> گزارش عملکرد
                 </a>
            </li>
            <li class="nav-item p-1  ">
                <a class="nav-link" href="{{ route('car-service.service') }}"> خدمات ثبت شده </a>
            </li>
                  @break

                  @case(2)
                  <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.order') }}">درخواست خدمت </a>
                </li>
                  <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.type-service.create') }}">ثبت خدمت </a>
                </li>
                <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.order.reportorder',auth()->user()->id) }}"> گزارش درخواستها
                     </a>
                </li>
                  @break

                  @case(3)
                  <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.service') }}"> خدمات ثبت شده </a>
                </li>
                  <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.order') }}">درخواست خدمت </a>
                </li>
                  <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.type-service.create') }}">ثبت خدمت </a>
                </li>
                <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.service.reportservice',auth()->user()->id) }}"> گزارش عملکرد
                     </a>
                </li>
                <li class="nav-item p-1  ">
                    <a class="nav-link" href="{{ route('car-service.order.reportorder',auth()->user()->id) }}"> گزارش درخواستها
                     </a>
                </li>
                  @break

          @endswitch


        <li class="nav-item p-1  ">
            <span class="ml-3 ml-md-5 position-relative">
                <span id="header-profile-toggle" class="pointer">

                    <span class="header-username">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</span>
            <i class="fas fa-angle-down"></i>
            </span>
            <section id="header-profile" class="header-profile rounded">
                <section class="list-group rounded">

                    <a href="{{ route('car-service.user.edit') }}" class="list-group-item list-group-item-action header-profile-link">
                        <i class="fas fa-user"></i>ویرایش پروفایل
                    </a>
                    <a href="{{ route('car-service.user.message',[auth()->user()->id,$type]) }}" class="list-group-item list-group-item-action header-profile-link">
                        <i class="far fa-envelope"></i>پیام ها

                    </a>
                    @if ($type==1 || $type==3)
                    <a href="{{ route('car-service.user.recharge') }}" class="list-group-item list-group-item-action header-profile-link">
                        <i class="fas fa-user"></i>شارژ حساب
                    </a>
                    @endif

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link"> <i class="fas fa-sign-out-alt"></i>خروج</button>
                    </form>


                    </a>
                </section>
            </section>
            </span>
            </li>

        @endauth

        <li class="nav-item p-1">
            @guest
          <a class="nav-link " href="{{route('login')}}">ثبت نام / ورود</a>

            @endguest


        </li>
      </ul>
    </div>
  </nav>
