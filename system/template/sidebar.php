<?=sidebar_li("DASHBOARD","home",$active_li,"fa-tachometer")?>

<li class="nav-item has-treeview <?=sidebar_parent($active_li,$master_tree,1)?>">
  <a href="#" class="nav-link <?=sidebar_parent($active_li,$master_tree)?>">
    <?=sidebar_ul("MASTER DATA", 'fa-book')?>
  </a>
  <ul class="nav nav-treeview">
    <?=sidebar_li("Branch","branch",$active_li)?>
    <?=sidebar_li("Employee","employee",$active_li)?>
    <?=sidebar_li("Products","product",$active_li)?>
    <?=sidebar_li("Product Category","product-category",$active_li)?>
    <?=sidebar_li("Product Unit","product-unit",$active_li)?>
  </ul>
</li>

<li class="nav-item has-treeview <?=sidebar_parent($active_li,$transaction_tree,1)?>">
  <a href="#" class="nav-link <?=sidebar_parent($active_li,$transaction_tree)?>">
    <?=sidebar_ul("TRANSACTIONS")?>
  </a>
  <ul class="nav nav-treeview">
    <?=sidebar_li("Purchase","purchase",$active_li)?>
    <?=sidebar_li("Product Repack","product-convert",$active_li)?>
    <?=sidebar_li("Sales","sales",$active_li)?>
  </ul>
</li>

<li class="nav-item has-treeview <?=sidebar_parent($active_li,$report_tree,1)?>">
  <a href="#" class="nav-link <?=sidebar_parent($active_li,$report_tree)?>">
    <?=sidebar_ul("REPORT", 'fa-print')?>
  </a>
  <ul class="nav nav-treeview">
    <?=sidebar_li("Inventory","prod-inv",$active_li)?>
    <?=sidebar_li("Sale","sale",$active_li)?>
  </ul>
</li>

<?=sidebar_li("SETTINGS","settings",$active_li,"fa-cog")?>
<?=sign_out()?>
