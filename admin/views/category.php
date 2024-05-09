<?php
	$sql_category = mysqli_query($connect, "SELECT * FROM CATEGORIES");
	$count_category = mysqli_num_rows($sql_category);
?>

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm </li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div>
					<a href="./index.php?quanly=category-insert" class="ms-2 me-2 btn btn-success">Thêm</a>
					<a href="javascript:void(0);" class="ms-2 me-2 btn btn-primary" onclick="redirectToUpdatePage()"> Sửa </a>
					<a href="" class="ms-2 me-2 btn btn-danger" onclick="deleteSelected()"> Xóa </a>
				</div>
			</div>
		</div>	

		<h6 class="mb-0 text-uppercase">Danh mục sản phẩm - <?php echo $count_category ?> danh mục</h6>
		<hr />
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr class="text-center">
								<th>Chọn</th>
								<th>Mã danh mục</th>
								<th>Tên danh mục</th>
								<th>Số sản phẩm</th>
								<th>Ghi chú</th>
								<th>Hình ảnh</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row_category = mysqli_fetch_array($sql_category)) {
							?>
								<tr class="align-middle">
									<td class="text-center"><input type="checkbox" name="selected_categories[]" value="<?php echo $row_category['CATEGORY_ID']; ?>"></td>
									<td class="text-center"><?php echo $row_category['CATEGORY_ID'] ?></td>
									<td><?php echo $row_category['CATEGORY_NAME'] ?></td>
									<td class="text-center"><?php echo $row_category['NUMBER_PRODUCT'] ?></td>
									<td><?php echo $row_category['CATEGORY_DESCRIPTION'] ?></td>
									<td class="text-center"><img src="<?php echo $row_category['CATEGORY_IMAGE'] ?>" width="150px" align-center></td>
								</tr>
							<?php
							}
							?>
						</tbody>

						<tfoot>
							<tr class="text-center">
								<th>Chọn</th>
								<th>Mã danh mục</th>
								<th>Tên danh mục</th>
								<th>Số sản phẩm</th>
								<th>Ghi chú</th>
								<th>Hình ảnh</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--end page wrapper -->

<script>
	function updateDeleteButtonState() {
		var selectedCategories = document.querySelectorAll('input[name="selected_categories[]"]:checked');
		var btnDeleteSelected = document.getElementById('btnDeleteSelected');
		btnDeleteSelected.disabled = selectedCategories.length === 0;
	}

	function deleteSelected() {
		var selectedCategories = document.querySelectorAll('input[name="selected_categories[]"]:checked');
		if (selectedCategories.length === 0) {
			alert("Vui lòng chọn ít nhất một danh mục để xóa.");
			return;
		}

		var confirmDelete = confirm("Bạn có chắc muốn xóa các danh mục đã chọn?");
		if (confirmDelete) {
			var categoryIds = Array.from(selectedCategories).map(function (checkbox) {
				return checkbox.value;
			});

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						// Successful response from the server
						alert(xhr.responseText); // Display success message or handle accordingly
						// You may want to reload or update the table after successful deletion
						location.reload();
					} else {
						// Error handling
						alert('Lỗi xóa: ' + xhr.statusText);
					}
				}
			};

			// Construct the URL for the delete operation
			var url = "./backend/category_delete.php?category_ids=" + categoryIds.join(",");

			// Open and send the request
			xhr.open("GET", url, true);
			xhr.send();
		}
	}

	// Thêm sự kiện change để cập nhật trạng thái của nút xóa khi checkbox thay đổi
	document.addEventListener('DOMContentLoaded', function () {
		var checkboxes = document.querySelectorAll('input[name="selected_categories[]"]');
		checkboxes.forEach(function (checkbox) {
			checkbox.addEventListener('change', updateDeleteButtonState);
		});
	});
</script>

<script>
    function redirectToUpdatePage() {
        var selectedCategories = document.querySelectorAll('input[name="selected_categories[]"]:checked');

        // Ensure that exactly one category is selected
        if (selectedCategories.length === 1) {
            var selectedCategoryId = selectedCategories[0].value;
            window.location.href = './index.php?quanly=category-update&category_id=' + selectedCategoryId;
        } else {
            alert("Vui lòng chỉ chọn một danh mục để sửa.");
        }
    }
</script>

