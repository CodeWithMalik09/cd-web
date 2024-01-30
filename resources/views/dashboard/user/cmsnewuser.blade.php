@extends('dashboard.layouts.dash')

@section('content')
    <div class="crtutor">
        <div class="crtutor__c">
            <form action="{{url('dashboard/new-cms-user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crtutor__c-l" style="width:100%;">
                    <h2>Add CMS User</h2>
                
                    <div class="form" style="display:flex;flex-direction:column;">
                        <div class="fr">
                            <div class="fi">
                                <label for="username">Name</label>
                                <input type="text" name="username" id="username" required>
                            </div>
                        </div>
                        
                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number</label>
                                <input type="tel" maxlength="10" name="phone" id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>
                        
                      
                        <div class="fr">
                            <div class="fi">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">Add User</button>
                </div>
              
            </form>
        </div>
    </div>
  
@endsection