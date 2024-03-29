<?php
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
 
Breadcrumbs::for('', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('user.index'));
});
Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('user.index'));
});
Breadcrumbs::for('login', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('user.index'));
});
Breadcrumbs::for('register', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('user.index'));
});
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail): void {
    $trail->push('List of users', route('user.index'));
});
Breadcrumbs::for('user.show', function (BreadcrumbTrail $trail,$user): void {
    $trail->parent('home');
    $trail->push('user', route('user.show', ['user' => $user]));
});
Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail,$user): void {
    $trail->parent('user.show',$user);
    $trail->push('edit', route('user.show', ['user' => $user]));
});
Breadcrumbs::for('budget.index', function (BreadcrumbTrail $trail): void {
    $trail->push('List of budgets', route('budget.index'));
});
Breadcrumbs::for('budget.show', function (BreadcrumbTrail $trail,$budget,$user): void {
    $trail->parent('user.show',$user);
    $trail->push('Budget', route('budget.show', ['budget'=>$budget,'user' => $user]));
});
Breadcrumbs::for('budget.edit', function (BreadcrumbTrail $trail,$budget,$user): void {
    $trail->parent('budget.show',$budget,$user);
    $trail->push('Budget ['.$budget->name.']', route('budget.show', ['budget' => $budget,'user' => $user]));
});
Breadcrumbs::for('budget.create', function (BreadcrumbTrail $trail,$user): void {
    $trail->parent('user.show',$user);
    $trail->push('Budget creation', route('user.show', ['user' => $user]));
});
Breadcrumbs::for('budget.update', function (BreadcrumbTrail $trail,$budget,$user): void {
    $trail->parent('budget.edit',$budget,$user);
    $trail->push('', route('budget.show', ['budget' => $budget,'user' => $user]));
});
Breadcrumbs::for('apsipirkimas.create', function (BreadcrumbTrail $trail,$budget,$user): void {
    $trail->parent('budget.show',$budget,$user);
    $trail->push('Apsipirkimas creation', route('budget.show', ['budget'=>$budget,'user' => $user]));
});
Breadcrumbs::for('apsipirkimas.show', function (BreadcrumbTrail $trail,$apsipirkimas,$budget,$user): void {
    $trail->parent('budget.show',$budget,$user);
    $trail->push('apsipirkimas', route('apsipirkimas.show', ['apsipirkimas'=>$apsipirkimas,'budget' => $budget,'user' => $user]));
});
Breadcrumbs::for('pirkinys.show', function (BreadcrumbTrail $trail,$pirkinys,$apsipirkimas,$budget,$user): void {
    $trail->parent('apsipirkimas.show',$apsipirkimas,$budget,$user);
    $trail->push('pirkinys', route('pirkinys.show', ['pirkinys'=>$pirkinys,'apsipirkimas'=>$apsipirkimas,'budget' => $budget,'user'=>$user]));
});

Breadcrumbs::for('role.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Roles', route('role.index'));
});
Breadcrumbs::for('role.show', function (BreadcrumbTrail $trail,$role): void {
    $trail->push('Show', route('role.show',['id'=>$role]));
});
Breadcrumbs::for('role.edit', function (BreadcrumbTrail $trail,$role): void {
    $trail->push('Editing', route('role.edit',['id'=>$role]));
});
Breadcrumbs::for('vendor.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Vendors', route('vendor.index'));
});
Breadcrumbs::for('friendship.destroy', function (BreadcrumbTrail $trail): void {
    $trail->push('friendship', route('friendship.destroy'));});
Breadcrumbs::for('friendshiprequest.index', function (BreadcrumbTrail $trail): void {
    $trail->push('friendshipRequests', route('friendshiprequest.index'));});
Breadcrumbs::for('friendshiprequest.store', function (BreadcrumbTrail $trail): void {
    $trail->push('friendshipRequests', route('friendshiprequest.store'));});
Breadcrumbs::for('friendshiprequest.destroy', function (BreadcrumbTrail $trail): void {
    $trail->push('friendshipRequests', route('friendshiprequest.destroy'));});
Breadcrumbs::for('friendshiprequest.show', function (BreadcrumbTrail $trail,$user): void {
    $trail->parent('user.show',$user);
    $trail->push('Friendships', route('friendshiprequest.show',['user' => $user]));});
Breadcrumbs::for('pakvietimas.index', function (BreadcrumbTrail $trail,$user): void {
    $trail->parent('user.show',$user);
    $trail->push('Pakvietimai', route('pakvietimas.index',['user' => $user]));
});
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail): void {
    $trail->push('List of categories', route('category.index'));
});