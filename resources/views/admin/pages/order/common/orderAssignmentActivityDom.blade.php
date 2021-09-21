<div class="row">
    <div class="col-md">
        <!-- general form elements -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Order Assignment Status Activities</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
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

                        @foreach($orderAssignmentActivities as $orderAssignmentActivity)
                        <td>
                            {{ $serialNo }}
                        </td>
                        <td>
                            @php
                            $serialNo++;
                            $imgpath = $orderAssignmentActivity->createdBy->avater ? '/storage/' . $orderAssignmentActivity->createdBy->avater : 'img/dummy-user.jpg';
                            @endphp
                            <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                            {{ $orderAssignmentActivity->createdBy->name }}
                        </td>
                        <td>
                            {{ $orderAssignmentActivity->created_at }}
                        </td>
                        <td>
                            {!! Form::submit($orderAssignmentActivity->orderStatus->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $orderAssignmentActivity->orderStatus->color . '; width: 80px;']) !!}
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $orderAssignmentActivities->links() }}
            </div>
        </div>
    </div>
</div>