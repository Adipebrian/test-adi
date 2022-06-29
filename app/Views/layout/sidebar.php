 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-primary elevation-4" style="background-color: #c1f8cf; color:#000;">
   <!-- Brand Logo -->
   <a href="/" class="brand-link text-center">
     <span class="brand-text font-weight-bold">Order</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="/../../assets/img/user/<?= user()->image ?>" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="/user" class="d-block"><?= user()->username ?></a>
       </div>
     </div>


     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item  <?= ($uri->getSegment(1) == "barang") ? 'menu-open' : '' ?>">
           <a href="#" class="nav-link <?= ($uri->getSegment(1) == "barang") ? 'active' : '' ?>">
             <i class="nav-icon fas fa-user-alt"></i>
             <p>
               Data Barang
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="/barang/index" class="nav-link <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Data</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item  <?= ($uri->getSegment(1) == "customer") ? 'menu-open' : '' ?>">
           <a href="#" class="nav-link <?= ($uri->getSegment(1) == "customer") ? 'active' : '' ?>">
             <i class="nav-icon fas fa-user-alt"></i>
             <p>
               Data Customer
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="/customer/index" class="nav-link <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Data</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item  <?= ($uri->getSegment(1) == "data") ? 'menu-open' : '' ?>">
           <a href="#" class="nav-link <?= ($uri->getSegment(1) == "data") ? 'active' : '' ?>">
             <i class="nav-icon fas fa-user-alt"></i>
             <p>
               Data Transaksi
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="/data/index" class="nav-link <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Data</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="/data/add" class="nav-link <?= ($uri->getSegment(2) == "add") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Add</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item  <?= ($uri->getSegment(1) == "user") ? 'menu-open' : '' ?>">
           <a href="#" class="nav-link <?= ($uri->getSegment(1) == "user") ? 'active' : '' ?>">
             <i class="nav-icon fas fa-user-alt"></i>
             <p>
               User
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="/user/index" class="nav-link <?= ($uri->getSegment(2) == "index") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Profile</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="/logout" class="nav-link <?= ($uri->getSegment(1) == "logout") ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Logout</p>
               </a>
             </li>
           </ul>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>