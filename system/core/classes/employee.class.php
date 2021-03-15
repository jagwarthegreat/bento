<?php

/**
 *   *=======*
 *         =*   *====*   *====*  *     *
 *       =*    *====*   *       *=====*
 *     =*     *        *       *     *
 *   =*      *=====   *====*  *     *
 *   *=======* S  O  L  U  T  I  O  N S
 * 
 *   Created on  :: January 2020
 *   Last Update :: March 12, 2020
 */
class EmployeeClass
{
	public function header()
	{
		return '<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
					<h1>Employee</h1>
					</div>
					<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="' . BASE_PATH . APP_FOLDER . 'home">Home</a></li>
						<li class="breadcrumb-item active">Master Data</li>
						<li class="breadcrumb-item active">Employee</li>
					</ol>
					</div>
				</div>
			</div>
		</section>';
	}
}
