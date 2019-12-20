<div class="col-sm-4 header_search">
  <div id="sosearchpro" class="search-pro">
    <form method="GET" action="{{route('client.search')}}">
      <div id="search0" class="search input-group">
        <div class="select_category filter_type  icon-select">
          <select class="no-border" name="category_id">
            <option value="0">Tất cả</option>
            @if ($categories)
              @foreach ($categories as $cate)
              <option value="{{$cate->id}}">{{ $cate->name }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off"
          placeholder="Tìm kiếm" name="search">
        <span class="input-group-btn">
          <button type="submit" class="button-search btn btn-primary" name="submit_search"><i
              class="fa fa-search"></i></button>
        </span>
      </div>
      <input type="hidden" name="route" value="product/search" />
    </form>
  </div>
</div>