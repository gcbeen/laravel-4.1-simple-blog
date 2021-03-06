@extends('l.admin', array('active' => $resource))

@section('title') @parent 编辑{{ $resourceName }} @stop

@section('beforeStyle')
    @parent
    {{ style('bootstrap-markdown') }}
@stop

@section('style')
.nav-tabs>li.active>a
{
    background-color: #f8f8f8 !important;
}
@parent @stop

@section('container')

    @include('w.notification')
    <h3>
        编辑{{ $resourceName }}
        <div class="pull-right">
            <a href="{{ route($resource.'.index') }}" class="btn btn-sm btn-default">
                &laquo; 返回{{ $resourceName }}列表
            </a>
        </div>
    </h3>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">主要内容</a></li>
        <li><a href="#tab-meta-data" data-toggle="tab">SEO</a></li>
        <li><a href="#tab-info" data-toggle="tab">文章相关信息</a></li>
    </ul>

    <form class="form-horizontal" method="post" action="{{ route($resource.'.update', $data->id) }}" autocomplete="off"
        style="background:#f8f8f8;padding:1em;border:1px solid #ddd;border-top:0;">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="PUT" />

        <!-- Tabs Content -->
        <div class="tab-content">

            <!-- General tab -->
            <div class="tab-pane active" id="tab-general" style="margin:0 1em;">

                <div class="form-group">
                    <label for="category">分类</label>
                    {{ $errors->first('category', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    {{ Form::select('category', $categoryLists, $data->category->id, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    <label for="title">标题</label>
                    {{ $errors->first('title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title', $data->title) }}" />
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    {{ $errors->first('slug', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <div class="input-group">
                        <span class="input-group-addon" >
                            {{ str_finish(URL::to('/'), '/') }}
                        </span>
                        <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug', $data->slug) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <textarea id="content" class="form-control" data-provide="markdown"
                        name="content" rows="10">{{ Input::old('content', $data->content_markdown) }}</textarea>
                </div>

            </div>

            <!-- Meta Data tab -->
            <div class="tab-pane" id="tab-meta-data" style="margin:0 1em;">

                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{ Input::old('meta_title', $data->meta_title) }}" />
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{ Input::old('meta_description', $data->meta_description) }}" />
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="{{ Input::old('meta_keywords', $data->meta_keywords) }}" />
                </div>

            </div>

            <!-- Info tab -->
            <div class="tab-pane" id="tab-info" style="margin:0 1em 2em 1em;">

                <div class="form-group">
                    <label>作者</label>
                    <p class="form-control-static">{{ $data->user ? $data->user->email : '作者信息丢失' }}</p>
                </div>

                <div class="form-group">
                    <label>创建时间</label>
                    <p class="form-control-static">{{ $data->created_at }}（{{ $data->friendly_created_at }}）</p>
                </div>

                <div class="form-group">
                    <label>最后修改时间</label>
                    <p class="form-control-static">{{ $data->updated_at }}（{{ $data->friendly_updated_at }}）</p>
                </div>

            </div>


        </div>

        <!-- Form actions -->
        <div class="control-group">
            <div class="controls">
                <a class="btn btn-default" href="{{ route($resource.'.edit', $data->id) }}">重 置</a>
                <button type="submit" class="btn btn-success">提 交</button>
            </div>
        </div>
    </form>

@stop

@section('end')
    @parent
    {{ script(array('markdown', 'to-markdown', 'bootstrap-markdown')) }}
@stop

