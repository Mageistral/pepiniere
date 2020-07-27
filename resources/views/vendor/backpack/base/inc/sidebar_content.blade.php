<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-database"></i> Données de base</a>
	<ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('fruit') }}'><i class='nav-icon la la-apple-alt'></i> {{ __('models.fruits.plural') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'><i class='nav-icon la la-globe-europe'></i> {{ __('models.regions.plural') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('level') }}'><i class='nav-icon la la-balance-scale'></i> {{ __('models.levels.plural') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('specificityCategory') }}'><i class='nav-icon la la-layer-group'></i> {{ __('models.specificities_categories.plural') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('specificity') }}'><i class='nav-icon la la-cogs'></i> {{ __('models.specificities.plural') }}</a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('rootstock') }}'><i class='nav-icon la la-pagelines'></i> {{ __('models.rootstocks.plural') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('developer') }}'><i class='nav-icon la la-user-nurse'></i> {{ __('models.developers.plural') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('rootstocksVigours') }}'><i class='nav-icon la la-sort-amount-up'></i> {{ __('models.rootstocks_vigours.plural') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('rootstockSpecificityLevel') }}'><i class='nav-icon la la-cogs'></i> {{ __('models.rootstocks_specificities_levels.plural') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('variety') }}'><i class='nav-icon la la-question'></i> Varieties</a></li>