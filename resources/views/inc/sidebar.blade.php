<nav id="sidebar">
                <div class="sidebar-header">
                    <a href="/"><img src="/tech-logo-vlad.png" alt="LOGO" style="max-width:70px;"></a>
                </div>

                <ul class="list-unstyled components">
                    <li>
                            <a href="/tasks">
                                <i class="glyphicon glyphicon-list-alt"></i>
                                My Tasks
                            </a>
                        </li>
                        <li>
                            <a href="/tasks/create">
                                <i class="glyphicon glyphicon-file"></i>
                                Create task
                            </a>
                        </li>
                        <li>
                            <a href="/projects">
                                <i class="fa fa-book"></i>
                                Projects
                            </a>
                        </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-envelope"></i>
                            Chat
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="/chat/users">Users</a></li>
                            <li><a href="/chat/projects">Projects</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-stats"></i>
                            My reports
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li><a href="/get-productivity/{{Auth::user()->id}}">Productivity</a></li>
                            <li><a href="/get-entertainment/{{Auth::user()->id}}">Entertainment</a></li>
                            <li><a href="/get-social/{{Auth::user()->id}}">Social media</a></li>
                            <li><a href="/get-overview/{{Auth::user()->id}}">Overview</a></li>
                            <li><a href="/report-deadline/{{Auth::user()->id}}">Deadline</a></li>
                            <li><a href="/report-time-spent/{{Auth::user()->id}}">Time on tasks</a></li>
                            <li><a href="/report-hours/{{Auth::user()->id}}">Working time</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/events">
                            <i class="glyphicon glyphicon-calendar"></i>
                            Calendar
                        </a>
                    </li>
                    <li>
                            <a href="/fileupl">
                                <i style="top:3px;" class="glyphicon glyphicon-cloud"></i>
                                Files
                            </a>
                        </li>
                </ul>
                @if (Auth::user()->id == 1)
                    <ul class="list-unstyled components">
                            <li>
                                <a href="/add-user">
                                        <i class="glyphicon glyphicon-user"></i>
                                        AddUser
                                    </a>
                            </li>
                        <li>
                            <a href="/gantt">
                                <i class="fa fa-object-group"></i>
                                Gantt chart
                            </a>
                        </li>
                        <li>
                            <a href="/reports">
                                <i class="fa fa-line-chart"></i>
                                Reports
                            </a>
                        </li>
                        <li>
                            <a href="/projects/create">
                                <i class="glyphicon glyphicon-edit"></i>
                                Create project
                            </a>
                        </li>
                    </ul>
                    @endif
            </nav>
