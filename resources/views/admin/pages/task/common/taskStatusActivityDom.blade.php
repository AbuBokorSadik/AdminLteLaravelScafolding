<div class="row">
    <div class="col-md">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Task Status Activities</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th width='5'>
                                Sl#
                            </th>
                            <th>
                                Created By
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Change Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $serialNo = 1;
                        @endphp

                        @foreach($taskStatusActivities as $taskStatusActivitity)
                        <td>
                            {{ $serialNo }}
                        </td>
                        <td>
                            @php
                            $serialNo++;
                            $imgpath = $taskStatusActivitity->createdBy->avatar ? '/storage/' . $taskStatusActivitity->createdBy->avatar : 'img/dummy-user.png';
                            @endphp
                            <div class="row">
                                <div class="col-6 text-right">
                                    <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                </div>
                                <dev class="col-6 text-left">
                                    {{ $taskStatusActivitity->createdBy->name }}
                                </dev>
                            </div>
                        </td>
                        <td>
                            {{ $taskStatusActivitity->created_at }}
                        </td>
                        <td>
                            {!! Form::submit($taskStatusActivitity->taskStatus->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $taskStatusActivitity->taskStatus->color . '; width: 100px;']) !!}
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $taskStatusActivities->links() }}
            </div>
        </div>
    </div>
</div>