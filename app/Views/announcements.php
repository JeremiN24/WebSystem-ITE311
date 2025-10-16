<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Announcements</h1>

<?php if (!empty($announcements)): ?>
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Date Posted</th>
    </tr>
    <?php foreach ($announcements as $a): ?>
    <tr>
        <td><?= esc($a['title']) ?></td>
        <td><?= esc($a['content']) ?></td>
        <td><?= esc($a['date_posted']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p>No announcements yet.</p>
<?php endif; ?>

</body>
</html>