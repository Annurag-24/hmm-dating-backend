# Server Setup Instructions - Hmm Dating Backend

## Image Storage Fix

### Problem:
Images showing 404 error because files are stored in wrong location.

### Solution:

**SSH into server:**
```bash
ssh root@72.60.206.177
# Password: Dating@123Hmm
```

**Navigate to Laravel project:**
```bash
cd /var/www/html
# or wherever the Laravel project is located
```

**Step 1: Create Storage Symlink**
```bash
php artisan storage:link
```

This creates: `public/storage` → `storage/app/public`

**Step 2: Move Existing Files (if any)**
```bash
# Check if old files exist
ls -la storage/app/uploads/

# If files exist, move them to public folder
mkdir -p storage/app/public/uploads
mv storage/app/uploads/* storage/app/public/uploads/
```

**Step 3: Set Permissions**
```bash
chmod -R 775 storage/
chown -R www-data:www-data storage/
chmod -R 775 public/storage/
```

**Step 4: Verify**
```bash
# Check symlink exists
ls -la public/storage

# Should show: storage -> /var/www/html/storage/app/public

# Test image access in browser:
# http://72.60.206.177/public/storage/uploads/[filename].jpg
```

---

## Code Changes Made:

**File:** `app/Models/GlobalFunction.php`

**Before:**
```php
$path = $file->store('uploads');
```

**After:**
```php
$path = $file->store('uploads', 'public');
```

This ensures new uploads go to `storage/app/public/uploads/` which is accessible via the symlink.

---

## URL Structure:

| Storage Path | Public URL |
|--------------|------------|
| `storage/app/public/uploads/xxx.jpg` | `http://72.60.206.177/public/storage/uploads/xxx.jpg` |

---

*Last Updated: January 11, 2026*
