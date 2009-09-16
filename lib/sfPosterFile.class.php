<?php

class sfPosterFile extends sfValidatedFile{
	public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
	{
		if (is_null($file))
		{
			$file = $this->generateFilename();
		}

		if ($file[0] != '/' && $file[0] != '\\' && !(strlen($file) > 3 && ctype_alpha($file[0]) && $file[1] == ':' && ($file[2] == '\\' || $file[2] == '/')))
		{
			if (is_null($this->path))
			{
				throw new RuntimeException('You must give a "path" when you give a relative file name.');
			}
			$smallFile = $this->path.DIRECTORY_SEPARATOR.'thumb_'.$file;
			$file = $this->path.DIRECTORY_SEPARATOR.$file;
		}

		// get our directory path from the destination filename
		$directory = dirname($file);
		if (!is_readable($directory))
		{
			if ($create && !mkdir($directory, $dirMode, true))
			{
				// failed to create the directory
				throw new Exception(sprintf('Failed to create file upload directory "%s".', $directory));
			}

			// chmod the directory since it doesn't seem to work on recursive paths
			chmod($directory, $dirMode);
		}
		if (!is_dir($directory))
		{
			// the directory path exists but it's not a directory
			throw new Exception(sprintf('File upload path "%s" exists, but is not a directory.', $directory));
		}
		if (!is_writable($directory))
		{
			// the directory isn't writable
			throw new Exception(sprintf('File upload path "%s" is not writable.', $directory));
		}

		// copy the temp file to the destination file
		$thumbnail = new sfThumbnail(250, 250, true, false, 95, 'sfGDAdapter');
		$thumbnail->loadFile($this->getTempName());
		$thumbnail->save($smallFile);
		
		$thumbnail = new sfThumbnail(600, 800, true, false, 95, 'sfGDAdapter');
		$thumbnail->loadFile($this->getTempName());
		$thumbnail->save($file);

		
		// chmod our file
		chmod($smallFile, $fileMode);
		chmod($file, $fileMode);

		$this->savedName = $file;
		return is_null($this->path) ? $file : str_replace($this->path.DIRECTORY_SEPARATOR, '', $file);
	}

}