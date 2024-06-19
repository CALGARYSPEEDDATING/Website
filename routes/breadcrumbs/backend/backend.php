<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});


Breadcrumbs::for('admin.event.index', function ($trail) {
    $trail->push('event', route('admin.event.index'));
});

Breadcrumbs::for('admin.event.calendar', function ($trail) {
    $trail->push('event', route('admin.event.calendar'));
});

Breadcrumbs::for('admin.event.create', function ($trail) {
    $trail->push('event', route('admin.event.create'));
});


Breadcrumbs::for('admin.event.search', function ($trail) {
    $trail->push('Event', route('admin.event.calendar'));
    $trail->push('Manage Events', route('admin.event.calendar'));
});
Breadcrumbs::for('admin.message.showtemplate', function ($trail) {
    $trail->push('Template', route('admin.message.showtemplate'));
    $trail->push('Message Template', route('admin.message.showtemplate'));
});

Breadcrumbs::for('admin.message.showEmailTemplate', function ($trail) {
    $trail->push('Email Template', route('admin.message.showEmailTemplate'));
    $trail->push('Save Email Template', route('admin.message.saveEmailTemplate'));
});

Breadcrumbs::for('admin.message.emailTemplateDetail', function ($trail, $id) {
    $trail->push('Email Template Detail', route('admin.message.emailTemplateDetail', $id));
});

Breadcrumbs::for('admin.event.show', function ($trail, $id) {
    $trail->push('Event', route('admin.event.index'));
    $trail->push('Event', route('admin.event.show', $id));
});

Breadcrumbs::for('admin.event.email-tracking', function ($trail, $id) {
    $trail->push('Event', route('admin.event.email-tracking', $id));
});

Breadcrumbs::for('admin.email.by-age-gender', function ($trail) {
    $trail->push('Event', route('admin.event.index'));
    $trail->push('Email', route('admin.email.by-age-gender'));
});

Breadcrumbs::for('admin.email.ownSubject', function ($trail) {
    $trail->push('Email', route('admin.email.ownSubject'));
});

Breadcrumbs::for('admin.email.individualMail', function ($trail) {
    $trail->push('Email', route('admin.email.individualMail'));
});

Breadcrumbs::for('blogetc.admin.index', function ($trail) {
    $trail->push('Blog', route('blogetc.admin.index'));
});

Breadcrumbs::for('admin.dynamic_pages', function ($trail) {
    $trail->push('Dynamic Pages', route('admin.dynamic_pages'));
});

Breadcrumbs::for('admin.add_dynamic_page', function ($trail) {
    $trail->push('Add Dynamic Pages', route('admin.add_dynamic_page'));
});

Breadcrumbs::for('admin.edit_dynamic_page', function ($trail, $id) {
    $trail->push('Edit Dynamic Pages', route('admin.edit_dynamic_page', $id));
});

Breadcrumbs::for('admin.destroy_dynamic_page', function ($trail, $id) {
    $trail->push('Destroy Dynamic Pages', route('admin.destroy_dynamic_page', $id));
});




require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
