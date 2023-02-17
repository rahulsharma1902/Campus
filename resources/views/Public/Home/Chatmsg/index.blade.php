@extends('Public.index')
@section('chatmsg')
<section>
    <style>
        .avatar-icon img {
            border-radius: 50%;
            height: 49px;
            width: 49px;
        }
        .sideBar-body:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
    </style>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                <div class="avatar-icon">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png">
                                </div>
                            </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <span> user name</span>
                                </div>
                        </div> 
                    </div>
                    <div class="card-body" style="height: 27rem; overflow: scroll;">
                    <!-- chat with -->
                        <div class="row sideBar-body ">
                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png">
                            </div>
                            </div>
                            <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                <span class="name-meta">John Doe
                                </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                <span class="time-meta pull-right">18:18
                                </span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <hr>
                    <!-- End chat with  -->
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                        <div class="card-header  bg-dark text-light">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                <div class="avatar-icon">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png">
                                </div>
                            </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <span> John Doe</span>
                                </div>
                        </div> 
                        </div>
                        <div class="card-body" style="height: 27rem;">
                        <div class="direct-chat-messages" style="display: flex;flex-direction: column-reverse; height: 25rem">
                                                <div class="direct-chat-msg left">
                      
                            

                            <div class="direct-chat-text  ">
                                hlo
                            </div>
                        </div>
                                           
                        </div>
                        <div class="card-footer sticky-footer  bg-dark text-light">
                            <div class="row">
                                <div class="col-lg-10">
                            <input type="text" class="form-control">
                          
                            </div>
                            <div class="col-lg-1">
                            <span>photo</span>
                            </div>
                            <div class="col-lg-1">
                            <button class="btn text-success"><i class="fas fa-paper-plane"></i></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

@endsection