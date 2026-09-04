<?php
/**
 * Student Portal Demo - Shared Sidebar
 */
$currentPage = basename($_SERVER['REQUEST_URI']);
$studentName = $_SESSION['student_name'] ?? 'Student';
$studentNo = $_SESSION['student_no'] ?? '';
?>
<aside class="demo-sidebar" id="sidebar">
    <div class="demo-sidebar-header">
        <div class="demo-avatar" style="background: #89b4fa;">
            <?= strtoupper(substr($studentName, 0, 1)) ?>
        </div>
        <div class="demo-sidebar-user">
            <div class="demo-sidebar-name"><?= htmlspecialchars($studentName) ?></div>
            <div class="demo-sidebar-id"><?= htmlspecialchars($studentNo) ?></div>
        </div>
    </div>
    <nav class="demo-sidebar-nav">
        <a href="/demo/dashboard" class="demo-nav-item <?= $currentPage === 'dashboard' ? 'active' : '' ?>">
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
            Dashboard
        </a>
        <a href="/demo/grades" class="demo-nav-item <?= $currentPage === 'grades' ? 'active' : '' ?>">
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
            My Grades
        </a>
        <a href="/demo/courses" class="demo-nav-item <?= $currentPage === 'courses' ? 'active' : '' ?>">
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/></svg>
            Courses
        </a>
        <a href="/demo/assignments" class="demo-nav-item <?= $currentPage === 'assignments' ? 'active' : '' ?>">
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd"/></svg>
            Assignments
        </a>
    </nav>
    <div class="demo-sidebar-footer">
        <a href="/demo/logout" class="demo-nav-item logout">
            <svg viewBox="0 0 20 20" fill="currentColor" width="18" height="18"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/></svg>
            Sign Out
        </a>
    </div>
</aside>
