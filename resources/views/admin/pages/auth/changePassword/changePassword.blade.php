@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="oldPassword">Old Password</label>
                                    <input type="email" class="form-control" id="oldPassword" placeholder="Old Password">
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label for="re-typePassword">Re-type Password</label>
                                    <input type="password" class="form-control" id="re-typePassword" placeholder="Re-type Password">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection