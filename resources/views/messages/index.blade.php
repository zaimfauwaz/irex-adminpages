@extends('layouts.chatbox')

@section('people')
    <ul class="list-unstyled chat-list mt-2 mb-0">
        <li class="clearfix">
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
            <div class="about">
                <div class="name">Vincent Porter</div>
                <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
            </div>
        </li>
        <li class="clearfix active">
            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
            <div class="about">
                <div class="name">Aiden Chavez</div>
                <div class="status"> <i class="fa fa-circle online"></i> online </div>
            </div>
        </li>
        <li class="clearfix">
            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
            <div class="about">
                <div class="name">Mike Thomas</div>
                <div class="status"> <i class="fa fa-circle online"></i> online </div>
            </div>
        </li>
        <li class="clearfix">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
            <div class="about">
                <div class="name">Christian Kelly</div>
                <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>
            </div>
        </li>
        <li class="clearfix">
            <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
            <div class="about">
                <div class="name">Monica Ward</div>
                <div class="status"> <i class="fa fa-circle online"></i> online </div>
            </div>
        </li>
        <li class="clearfix">
            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
            <div class="about">
                <div class="name">Dean Henry</div>
                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
            </div>
        </li>
    </ul>
@endsection

@section('owner')
    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
    </a>
    <div class="chat-about">
        <h6 class="m-b-0">Aiden Chavez</h6>
        <small>Last seen: 2 hours ago</small>
    </div>
@endsection

@section('history')
    <ul class="m-b-0">
        <li class="clearfix">
            <div class="message-data text-right">
                <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
            </div>
        </li>
        <li class="clearfix">
            <div class="message my-message">Are we meeting today?</div>
        </li>
        <li class="clearfix">
            <div class="message my-message">Project has been already finished and I have results to show you.</div>
        </li>
    </ul>
@endsection
