<nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Logo</h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="/home">
                            <i class="glyphicon glyphicon-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/chat">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Activity stream
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-duplicate"></i>
                            Chat
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="/chat/users">Users</a></li>
                            <li><a href="/chat/groups">Groups</a></li>
                            <li><a href="/chat/projects">Projects</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/gantt">
                            <i class="glyphicon glyphicon-link"></i>
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="/events">
                            <i class="glyphicon glyphicon-calendar"></i>
                            Calendar
                        </a>
                    </li>
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
                </ul>
                @if (Auth::user()->id == 1)
                    <ul class="list-unstyled components">
                        <li>
                            <a href="/add-user">
                            <i class="glyphicon glyphicon-plus">AddUser</i>
                            </a>
                        </li>
                    </ul>
                    @endif
            </nav>
