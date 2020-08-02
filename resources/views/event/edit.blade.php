@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/event/update/'.$event->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('event_title') ? ' has-error' : '' }}">
                            <label for="event_title" class="col-md-4 control-label">Event Title</label>

                            <div class="col-md-6">
                                <input id="event_title" type="text" class="form-control" name="event_title" value="{{ $event->event_title }}">
                                <small class="form-text text-muted">Insert your event title. General markdown syntax is supported in this field</small>

                                @if ($errors->has('event_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-8">
                                <textarea id="event_description" name="event_description" class="form-control" rows="8">{{ $event->event_description }}</textarea>
                                <small class="form-text text-muted">Insert your event description here, general markdown syntax is also supported. You can also tag Roles and user by using <code><@&Role_ID></code> for roles, and <code><@user-id></code> for user.</small>
                                @if ($errors->has('event_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mentions') ? ' has-error' : '' }}">
                            <label for="mention" class="col-md-4 control-label">Mentions</label>

                            <div class="col-md-8">
                                <input type="text" id="mentions" name="mentions" class="form-control" value="{{$event->mentions}}" />
                                <small class="form-text text-muted">Mentions will get inserted into the <code>content:</code> section of the Webhook payload. You can mention Roles and user by using <code><@&Role_ID></code> for roles, and <code><@user-id></code> for user. you can use mention multiple roles and/or user using any separator you want</small>
                                @if ($errors->has('mentions'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mentions') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_image_url') ? ' has-error' : '' }}">
                            <label for="event_image_url" class="col-md-4 control-label">Event Image URL</label>

                            <div class="col-md-6">
                                <input id="event_image_url" type="text" class="form-control" name="event_image_url" value="{{$event->event_image_url}}">
                                <small class="form-text text-muted">Insert your event cover image here if any. Leave it empty otherwise</small>

                                @if ($errors->has('event_image_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_image_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="time" class="col-md-4 control-label">Event Time</label>

                            <div class="col-md-6">
                                <input id="time" type="text" class="form-control" name="time" value="{{ $event->time }}">
                                <small class="form-text text-muted">Please insert time in a 24-hour format (e.g 07:30, 22:30) or the webhook won't send the notification. You can insert multiple times using ',' comma to send the webhook multiple times in a day.</small>

                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-check"></i> Done
                                </button>
                            </div>
                        </div>
                    </form>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection