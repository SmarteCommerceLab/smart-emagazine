<?php

$root = dirname(__DIR__);
$expected_legacy_eval = 4;
$eval_count = 0;

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
foreach ($iterator as $file) {
	if (!$file->isFile() || $file->getExtension() !== 'php' || strpos($file->getPathname(), DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR) !== false) {
		continue;
	}
	$eval_count += substr_count((string) file_get_contents($file->getPathname()), 'eval(');
}

if ($eval_count > $expected_legacy_eval) {
	fwrite(STDERR, "New dynamic PHP execution detected.\n");
	exit(1);
}

echo "Security baseline OK; legacy eval occurrences: {$eval_count}.\n";
