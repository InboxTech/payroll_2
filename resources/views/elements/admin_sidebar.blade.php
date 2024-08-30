    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link">
            <img src="{{ asset(getImage(getSettingData('config_company_logo'))) }}" style="width: 100%;">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @php
        $action = request()->route()->getAction();
        $controller_action = explode('@', class_basename($action['controller']));
        $current_controller = $controller_action[0];
        $current_action = $controller_action[1];
    @endphp

    <ul class="menu-inner py-1">
        <li class="menu-item @if($current_action == 'dashboard') active @endif">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        @php
            $controller = array('DesignationController', 'DepartmentController');
            $action = array('index');
        @endphp
        @canany(['view-designation', 'view-department'])
            <li class="menu-item {{ in_array($current_controller,$controller)? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-box"></i>
                    <div data-i18n="Master">Master</div>
                </a>
                <ul class="menu-sub">
                    @can('view-designation')
                        <li class="menu-item @if($current_controller == 'DesignationController') active @endif">
                            <a href="{{ route('designation.index') }}" class="menu-link">
                                <div data-i18n="Designation">Designation</div>
                            </a>
                        </li>
                    @endcan
                    @can('view-department')
                        <li class="menu-item @if($current_controller == 'DepartmentController') active @endif">
                            <a href="{{ route('department.index') }}" class="menu-link">
                                <div data-i18n="Department">Department</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @php
            $controller = array('RoleController');
            $action = array('index');
        @endphp
        @can('view-role')
            <li class="menu-item {{ in_array($current_controller,$controller)? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item @if($current_controller == 'RoleController') active @endif">
                        <a href="{{ route('role.index') }}" class="menu-link">
                            <div data-i18n="Roles">Roles</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @php
            $controller = array('UserController');
            $action = array('index');
        @endphp
        @can('view-employee')
            <li class="menu-item @if($current_controller == 'UserController') active @endif">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Employee">Employee</div>
                </a>
            </li>
        @endcan
        
        @php
            $controller = array('LeaveController', 'LeaveApplyController', 'AppliedLeaveController');
            $action = array('index');
        @endphp
        @canany(['view-leave', 'view-leave-apply', 'view-applied-leave'])
            <li class="menu-item {{ in_array($current_controller,$controller)? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div data-i18n="Leave">Leave</div>
                </a>
                <ul class="menu-sub">
                    @can('view-leave')
                        <li class="menu-item @if($current_controller == 'LeaveController') active @endif">
                            <a href="{{ route('leave.index') }}" class="menu-link">
                                <div data-i18n="Leave">Leave</div>
                            </a>
                        </li>
                    @endcan
                    @can('view-leave-apply')
                        <li class="menu-item @if($current_controller == 'LeaveApplyController') active @endif">
                            <a href="{{ route('leaveapply.index') }}" class="menu-link">
                                <div data-i18n="Leave Apply">Leave Apply</div>
                            </a>
                        </li>
                    @endcan
                    @can('view-applied-leave')
                        <li class="menu-item @if($current_controller == 'AppliedLeaveController') active @endif">
                            <a href="{{ route('appliedleave.index') }}" class="menu-link">
                                <div data-i18n="Applied Leave">Applied Leave</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @php
            $controller = array('PunchInOutController', 'AttendenceReportController', 'AttendanceCorrectionController');
            $action = array('index');
        @endphp
        <li class="menu-item {{ in_array($current_controller,$controller)? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-calendar-stats"></i>
                <div data-i18n="Attendance">Attendance</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if($current_controller == 'PunchInOutController') active @endif">
                    <a href="{{ route('punchinout.index') }}" class="menu-link">
                        <div data-i18n="Punch In-Out">Punch In-Out</div>
                    </a>
                </li>
                @can('employee-list-attendance-correction')
                    <li class="menu-item @if($current_controller == 'AttendanceCorrectionController') active @endif">
                        <a href="{{ route('attendancecorrection.index') }}" class="menu-link">
                            <div data-i18n="Attendance Correction">Attendance Correction</div>
                        </a>
                    </li>
                @endcan
                @can('employee-list-attendancereport')
                    <li class="menu-item @if($current_controller == 'AttendenceReportController') active @endif">
                        <a href="{{ route('attendencereport.index') }}" class="menu-link">
                            <div data-i18n="Attendance Report">Attendance Report</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        
        @php 
            $controller = array('SalaryController');
            $action = array('index');
            $roleId= array(1, 2);
        @endphp
        @can('view-salary')
            <li class="menu-item @if($current_controller == 'SalaryController') active @endif">
                <a href="{{ (in_array(Auth::user()->roles()->first()->id, $roleId)) ? route('salary.index') : route('salary.employeesalary') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                    <div data-i18n="Salary">Salary</div>
                </a>
            </li>
        @endcan

        @php 
            $controller = array('SettingController');
            $action = array('index');
        @endphp
        @can('edit-setting')
            <li class="menu-item @if($current_controller == 'SettingController') active @endif">
                <a href="{{ route('setting.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Setting">Setting</div>
                </a>
            </li>
        @endcan

        @php
            $controller = array('ProjectController', 'TaskController');
            $action = array('index');
        @endphp
        <li class="menu-item {{ in_array($current_controller,$controller)? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-calendar-stats"></i>
                <div data-i18n="Project & Task Management">Project & Task Management</div>
            </a>
            <ul class="menu-sub">
                
                    <li class="menu-item @if($current_controller == 'ProjectController') active @endif">
                        <a href="{{ route('project.index') }}" class="menu-link">
                            <div data-i18n="Project">Project</div>
                        </a>
                    </li>
                
                    <li class="menu-item @if($current_controller == 'TaskController') active @endif">
                        <a href="{{ route('task.index') }}" class="menu-link">
                            <div data-i18n="Task">Task</div>
                        </a>
                    </li>
                
            </ul>
        </li>
    </ul>