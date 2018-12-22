<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            {!! Form::radio("meta_robot_no_index", "index",
            old("meta_robot_no_index", @$model->meta_robot_no_index == 'index' || !isset($model) ? 1 : 0), ['class' => 'flat-blue']) !!}
            {!! Form::label("meta_robot_no_index", trans('sitemap::sitemap.form.index')) !!}
            {!! Form::radio("meta_robot_no_index", "noindex",
            old("meta_robot_no_index", @$model->meta_robot_no_index == 'noindex' ? 1 : 0), ['class' => 'flat-blue']) !!}
            {!! Form::label("meta_robot_no_index", trans('sitemap::sitemap.form.no_index')) !!}
            {!! $errors->first("meta_robot_no_index", '<span class="help-block">:message</span>') !!}
            <br/>
            {!! Form::radio("meta_robot_no_follow", "follow",
            old("meta_robot_no_follow", @$model->meta_robot_no_follow == 'follow' || !isset($model) ? 1 : 0), ['class' => 'flat-blue']) !!}
            {!! Form::label("meta_robot_no_follow", trans('sitemap::sitemap.form.follow')) !!}
            {!! Form::radio("meta_robot_no_follow", "nofollow",
            old("meta_robot_no_follow", @$model->meta_robot_no_follow == 'nofollow' ? 1 : 0), ['class' => 'flat-blue']) !!}
            {!! Form::label("meta_robot_no_follow", trans('sitemap::sitemap.form.no_follow')) !!}
            {!! $errors->first("meta_robot_no_follow", '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            {!! Form::normalSelect('sitemap_frequency', trans('sitemap::sitemap.form.frequency'), $errors, $sitemapFrequencies,
            old('sitemap_frequency', @$model->sitemap_frequency ? $model->sitemap_frequency : 'weekly')) !!}
        </div>
        <div class="form-group">
            {!! Form::normalSelect('sitemap_priority', trans('sitemap::sitemap.form.priority'), $errors, $sitemapPriorities,
            old('sitemap_priority', @$model->sitemap_priority ? $model->sitemap_priority : '0.9')) !!}
        </div>
        <div class="form-group">
            {!! Form::hidden("sitemap_include", 0) !!}
            {!! Form::checkbox("sitemap_include", 1,
            old("sitemap_include", @$model->sitemap_include == 1 ? 1 : 0), ['class' => 'flat-blue']) !!}
            {!! Form::label("sitemap_include", trans('sitemap::sitemap.titles.sitemap')) !!}
            {!! $errors->first("sitemap_include", '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>