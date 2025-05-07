<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>



<?php if (!empty($bank_accounts)) : ?>
    <?php foreach ($bank_accounts as $key => $account) : ?>
        <div class="bank-account row mb-3">
            <input type="hidden" name="account_id[]" value="<?= esc($account['account_id']) ?>">
            </div>
    <?php endforeach; ?>
<?php endif; ?>



<input class="form-check-input" type="checkbox" id="is_active_<?= $key ?>" name="is_active[]" value="<?= esc($account['account_id']) ?>" <?= $account['is_active'] ? 'checked' : '' ?>>



<button type="button" class="btn btn-danger delete-bank-account" data-account-id="<?= esc($account['account_id']) ?>">ลบ</button>
document.addEventListener('DOMContentLoaded', function() {
    // ... โค้ด JavaScript เดิม ...

    bankAccountsList.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-bank-account')) {
            const accountId = event.target.getAttribute('data-account-id');
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีนี้?')) {
                // ส่ง AJAX Request ไปยัง Controller เพื่อลบบัญชีตาม ID
                fetch('<?= site_url('payment-settings/delete_bank_account/') ?>' + accountId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest' // ระบุว่าเป็น AJAX Request
                    },
                    body: '<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.closest('.bank-account').remove();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('เกิดข้อผิดพลาด:', error);
                    alert('เกิดข้อผิดพลาดในการลบบัญชี');
                });
            }
        }
    });
});
