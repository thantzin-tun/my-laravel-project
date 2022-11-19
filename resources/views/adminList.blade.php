<div class="noti-wrap">
  <div class="noti__item js-item-menu">
    <i class="fa-solid fa-address-book"></i>
    <span class="quantity">{{count($data)}}</span>
    <div class="notifi-dropdown js-dropdown">
      <div class="notifi__title">
        <h5 class="text-danger">Admin List</h5>
      </div>
      <div class="notiItem">
          @foreach($data as $d)
          <div class="notifi__item">
            <div class="bg-c1 img-cir img-40 userInfo">
              @if($d->image == null)
                @if($d->gender == 'female')
                <img src="{{asset('admin/images/images.jpg')}}" alt="admin" />
                @else
                <img src="{{asset('admin/images/userOne.png')}}" alt="admin" />
                @endif
                @else
                <img src="{{ asset('storage/'.$d->image) }}" alt="admin" />
              @endif
            </div>
            <div class="content">
              <p>{{$d->name}}</p>
              <span class="date">{{$d->email}}</span>
              <br>
              <span class="date">{{$d->phone}}</span>
              <br>
              <span class="date">{{$d->address}}</span>
            </div>
          </div>
          @endforeach
      </div>
    </div>
  </div>
</div>