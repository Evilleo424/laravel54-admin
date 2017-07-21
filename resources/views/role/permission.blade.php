@extends('layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">权限列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/roles/{{$role->id}}/permission" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                {{--@foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   @if ($myPermissions->contains($permission))
                                                   checked
                                                   @endif
                                                   value="{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                @endforeach--}}

                                @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   @if (in_array($permission['id'],$myPermissions))
                                                   checked
                                                   @endif
                                                   value="{{$permission['id']}}">{{$permission['name']}}
                                        </label>
                                        <br/>
                                        @if(count($permission['children']) != 0)
                                            @foreach($permission['children'] as $children)
                                                @foreach($children as $sub_children)
                                                    <label>
                                                        <input type="checkbox" name="permissions[]"
                                                               @if (in_array($sub_children['id'],$myPermissions))
                                                               checked
                                                                @endif
                                                               value="{{$sub_children['id']}}">{{$sub_children['name']}}
                                                    </label>
                                                @endforeach
                                                <br/>
                                            @endforeach

                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                        @include('layout.error')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection