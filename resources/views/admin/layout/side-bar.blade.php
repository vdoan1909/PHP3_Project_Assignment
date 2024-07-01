<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span>Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs('admin.index') ? 'active' : '' }}"
                    href="{{ route('admin.index') }}">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs(['admin.subjects.index', 'admin.subjects.create', 'admin.subjects.edit']) ? 'active' : '' }}"
                    href="#subject" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="subject">
                    <i class="ri-book-fill"></i> <span>Subjects</span>
                </a>
                <div class="collapse menu-dropdown" id="subject">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.subjects.index') }}"
                                class="nav-link {{ Request::RouteIs('admin.subjects.index') ? 'active' : '' }}">
                                List Subjects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subjects.create') }}"
                                class="nav-link {{ Request::RouteIs('admin.subjects.create') ? 'active' : '' }}">
                                Create Subject
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs(['admin.exams.index', 'admin.exams.create', 'admin.exams.edit']) ? 'active' : '' }}"
                    href="#exam" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="exam">
                    <i class="ri-timer-fill"></i> <span>Exams</span>
                </a>
                <div class="collapse menu-dropdown" id="exam">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.exams.index') }}"
                                class="nav-link {{ Request::RouteIs('admin.exams.index') ? 'active' : '' }}">
                                List Exams
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.exams.create') }}"
                                class="nav-link {{ Request::RouteIs('admin.exams.create') ? 'active' : '' }}">
                                Create Exams
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs(['admin.questions.index', 'admin.questions.import', 'admin.questions.edit'])
                    ? 'active'
                    : '' }}"
                    href="#question" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="question">
                    <i class="ri-questionnaire-fill"></i> <span>Questions</span>
                </a>
                <div class="collapse menu-dropdown" id="question">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.questions.index') }}"
                                class="nav-link {{ Request::RouteIs('admin.questions.index') ? 'active' : '' }}">
                                List Questions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.questions.import') }}"
                                class="nav-link {{ Request::RouteIs('admin.questions.import') ? 'active' : '' }}">
                                Create Questions
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
