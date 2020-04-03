<?PHP
file_exists()
bool file_exists(string path)
Returns true if the file at path exists and false if not.
file_exists() is used to check if a file, wait for it, exists!
If you want to see if a file exists without actually opening it, you can use file_exists() like so:
 
if (file_exists("jobsinqueue.txt")) {
echo 'There are jobs in the queue waiting to be processed.';
} else {
echo 'There are currently no jobs in the queue.';
}
is_file()
bool is_file(string path)
is_file returns true if path exists and is a file, otherwise it returns false.
 

var_dump(is_file('atextfile.txt'));  //  true
var_dump(is_file('/app/blog/'));  //  false
is_readable()
bool is_readable(string path)
is_readable returns true if path exists and is readable, otherwise it returns false.
 
$filename = 'thefile.txt';
if (is_readable($filename)) {
    echo 'The file is readable!';
} else {
    echo 'The file is not readable';
}
is_writable()
bool is_writable(string path)
is_writable returns true if path exists and is a directory, otherwise it returns false.
 
$filename = 'writetome.txt';
if (is_writable($filename)) {
    echo 'We can write to the file!';
} else {
    echo 'Sorry, this file is not writable.';
}
filesize()
int filesize(string path)
You can check the size of a file by using the filesize() function. filesize returns the size of a file in bytes and can be used in conjunction with fread() to read a whole file (or just a part of the file) at a time. If the file does not exist or any other error occurs, the function returns false.

fopen()
resource fopen(string path, string mode[, bool include [, resource context ]] )
fopen opens the file specified by path and returns a file resource handle to the open file. If path begins with http://, an HTTP connection is opened and a file pointer to the start of the response is returned. If path begins with ftp://, an FTP connection is opened and a file pointer to the start of the file is returned; the remote server must support passive FTP. If path is php://stdin, php://stdout, or php://stderr, a file pointer to the appropriate stream is returned. Be aware of the different options with fopen()

Mode
Name
Meaning
r	Read	Open the file for reading, beginning from the start of the file.
r+	Read	Open the file for reading and writing, beginning from the start of the file.
w	Write	Open the file for writing, beginning from the start of the file. If the file already exists, delete the existing contents. If it does not exist, try to create it.
w+	Write	Open the file for writing and reading, beginning from the start of the file. If the file already exists, delete the existing contents. If it does not exist, try to create it.
x	Cautious write	Open the file for writing, beginning from the start of the file. If the file already exists, it will not be opened, fopen() will return false, and PHP will generate a warning.
x+	Cautious write	Open the file for writing and reading, beginning from the start of the file. If the file already exists, it will not be opened, fopen() will return false, and PHP will generate a warning.
a	Append	Open the file for appending (writing) only, starting from the end of the existing contents, if any. If it does not exist, try to create it.
a+	Append	Open the file for appending (writing) and reading, starting from the end of the existing contents, if any. If it does not exist, try to create it.
b	Binary	Used in conjunction with one of the other modes.You might want to use this mode if your file system differentiates between binary and text files.Windows systems differentiate; Unix systems do not.The PHP developers recommend you always use this option for maximum portability. It is the default mode.
t	Text	Used in conjunction with one of the other modes.This mode is an option only in Windows systems. It is not recommended except before you have ported your code to work with the b option.
ftell()
int ftell(resource handle)
ftell returns how far into the file the pointer is in bytes. If an error occurs, it returns false.
 
$fp = fopen("composer.json", "r");
$data = fgets($fp, 2);
 

echo ftell($fp); // 1
 
fclose($fp);
fwrite() alias is fputs()
int fwrite(resource handle, string string[, int length])
fwrite writes string to the file referenced by handle. The file must be open with write privileges. If length is given, only that many bytes of the string will be written. Returns the number of bytes written, or −1 on error.

Writing to a file in PHP is fairly easy. You can use either of the functions fwrite() (file write) or fputs() (file put string). fputs() is an alias to fwrite(). I’m not sure why there are functions named differently but do the same thing in PHP, but we do have these alias functions at times. You call fwrite() in the following way:

 
$fp = fopen("text.txt", "w");
 
fwrite($fp, 'Some awesome text!');
 
readfile('text.txt');  //  Some awesome text!
fclose()
bool fclose(int handle)
After you’ve finished using a file, you should close it as a best practice with fclose. You should do this by using the fclose() function as follows:

1
fclose($fp);
This function returns true if the file was successfully closed or false if it was not.

fread() alias is fgets()
string fread(int handle, int length)
You can use the fread() function to read an arbitrary number of bytes from the file. fread reads up to length bytes, to the end of the file or network packet, whichever comes first.

 
$filename = "text.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
 
var_dump($contents);  //  string 'Some awesome text!' (length=18)
file_get_contents()
string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] )
file_get_contents is an incredibly powerful function, file_get_contents() reads the file at path and returns its contents as a string, optionally starting at offset. If include is specified and is true, the include path is searched for the file. The length of the returned string can also be controlled with the maxlen parameter.
 
$contents = file_get_contents('text.txt');
echo $contents;  //  Some awesome text!
file_put_contents()
int file_put_contents ( string $filename , mixed $data [, int $flags = 0 [, resource $context ]] )
A close cousin of the file_get_contents() function and an alternative to fwrite() is the file_put_contents() function. file_put_contents makes your life easy and writes the string contained in data to the file named in filename without any need for an fopen() (or fclose()) function call! Returns the number of bytes written to the file, or −1 on error. The flags argument is a bitfield with two possible values:
FILE_USE_INCLUDE_PATH If specified, the include path is searched for the file and the file is written at the first location where the file already exists.
FILE_APPEND If specified and if the file specified by path already exists, string is appended to the existing contents of the file.
LOCK_EX Exclusively lock the file before writing to it. Useful for preventing race conditions during file writing.
 
$contents = 'The most awesome text yet!';
file_put_contents('text.txt', $contents);
 
readfile('text.txt');  //  The most awesome text yet!
file()
array file(string filename[, int flags [, resource context ]])
This handy function works a lot like readfile() except that instead of echoing the file to standard output, it turns it into an array. Each key of the array contains one line of the file. Flags can be one or more of the following constants when using the file function:
FILE_USE_INCLUDE_PATH Search for the file in the include path as set in the php.ini file.
FILE_IGNORE_NEW_LINES Do not add a newline at the end of the array elements.
FILE_SKIP_EMPTY_LINES Skip any empty lines.

We have modified our text.txt file for an example and placed several lines of text on new lines. Now you can see how the file() function reads the text in, and assembles an array:

 
$contents = file('text.txt');
print_r($contents);
 
Array
(
    [0] => The most awesome text yet!
 
    [1] => This is line 2.
 
    [2] => This is line number 3.
 
    [3] => You guessed it, you have reached line 4!
)
glob()
array glob ( string $pattern [, int $flags = 0 ] )
glob returns a list of filenames matching the shell wildcard pattern given in pattern. The following characters and sequences make matches:
* Matches any number of any character (equivalent to the regex pattern .*)
? Matches any one character (equivalent to the regex pattern .)
For example, to process every JPEG file in a particular directory, you might write:
 


foreach(glob("/tmp/images/*.jpg") as $filename) {
// do something with $filename
}
The flags value is a bitwise OR of any of the following values:
GLOB_MARK Adds a slash to each item returned.
GLOB_NOSORT Returns files in the same order as found in the directory itself. If this is not specified, the names are sorted by ASCII value.
GLOB_NOCHECK If no files matching pattern are found, pattern is returned.
GLOB_NOESCAPE Treat backslashes in pattern as backslashes, rather than as the start of an escape sequence.
GLOB_BRACE In addition to the normal matches, strings in the form {foo, bar, baz}match either “foo”, “bar”, or “baz”.
GLOB_ONLYDIR Returns only directories matching pattern.
GLOB_ERR Stop on read errors.

basename()
string basename ( string $path [, string $suffix ] )
The basename() function gets the name of the file without the directory.

For example we could use basename like this:



$path = "/usr/local/httpd/index.html";
echo(basename($path)); // index.html
echo(basename($path, '.html')); // index
dirname()
string dirname ( string $path )
The dirname() function gets the directory name without the filename. dirname includes everything up to the filename portion and doesn’t include the trailing path separator.



$dir = dirname(__FILE__); 
echo $dir;  //  C:wampwwwphpconsole
pathinfo()
mixed pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] )
pathinfo returns an associative array containing information about path. If the options parameter is given, it specifies a particular element to be returned. PATHINFO_DIRNAME, PATHINFO_BASENAME, PATHINFO_EXTENSION, and PATHINFO_FILENAME are valid options values.




$array = pathinfo('krumo/krumo.js');
print_r($array);
 
Array
(
    [dirname] => krumo
    [basename] => krumo.js
    [extension] => js
    [filename] => krumo
)
realpath()
string realpath ( string $path )
realpath expands all symbolic links, resolves references to /./ and /../, removes extra / characters in path, and returns the result.




$string = realpath('krumo/krumo.js');
 
echo $string;  //  C:wampwwwphpconsolekrumokrumo.js
unlink()
bool unlink ( string $filename [, resource $context ] )
unlink deletes the file path, using the streams context context if provided. Returns true if the operation was successful and false if not. This situation typically occurs if the permissions on the file are insufficient or if the file does not exist.



unlink('text.txt');
 
readfile('text.txt');  //  error no such file exists! (we just deleted it)
rename()
bool rename(string old, string new[, resource context]))
The rename() function does double duty as a function to move files from place to place since PHP does not include a move function. Whether you can move files from file system to file system and whether files are overwritten when rename is used will likely depend on your server environment, so be sure to check the effects on your server.



rename('text.txt', 'newtext.txt');  //  text.txt is now newtext.txt
 
rename('newtext.txt', 'krumo/inKrumoDirectoryNow.txt');
//  newtext.txt is now moved and renamed in one shot
//  newtext.txt no longer exists in the original directory!
copy()
int copy(string path, string destination[, resource context ])
copy copies the file at path to destination. If the operation succeeds, the function returns true, otherwise it returns false. If the file at the destination exists, it will be replaced. The optional context parameter can make use of a valid context resource created with the stream_context_create() function.




copy('krumo/inKrumoDirectoryNow.txt', 'copied.txt');
//  copied.txt is now in the destination directory
//  inKrumoDirectoryNow.txt still exists in the source directory
filemtime()
int filemtime(string path)
filemtime returns the last-modified time, as a Unix timestamp value, for the file path.




$modified = filemtime('copied.txt');
 
echo $modified;  //  1395861849
is_dir()
bool is_dir(string path)
is_dir returns true if path exists and is a directory, otherwise it returns false.

mkdir()
bool mkdir(string path[, int mode [, bool recursive [, resource context ]]])
mkdir creates the directory path with mode permissions. The mode is expected to be an octal number such as 0755. An integer value such as 755 or a string value such as “u+x” will not work as expected. Returns true if the operation was successful and false if not. If recursive is used, it allows for the creation of nested directories.

opendir()
resource opendir(string path[, resource context])
opendir opens the directory path and returns a directory handle for the path that is suitable for use in subsequent readdir(), rewinddir(), and closedir() calls. If path is not a valid directory, if permissions do not allow the PHP process to read the directory, or if any other error occurs, false is returned. Its use is similar to the use of fopen() for reading from files. Instead of passing it a filename, you should pass it a directory name. The function returns a directory handle, again in much the same way as fopen() returns a file handle. When the directory is open, you can read a filename from it by calling readdir($dir), as shown in the example. This function returns false when there are no more files to be read. Note that it will also return false if it reads a file called 0; in order to guard against this, we can explicitly test to make sure the return value is not equal to false:



$dir = opendir($current_dir);
while(false !== ($file = readdir($dir))) {
    //  do stuff
}
When you are finished reading from a directory, you call closedir($dir) to finish. This is again similar to calling fclose() for a file.

readdir()
string readdir([resource handle])
readdir returns the name of the next file in the directory referenced by handle. If not specified, handle defaults to the last directory handle resource returned by opendir(). The order in which files in a directory are returned by calls to readdir() is undefined. If there are no more files in the directory to return, readdir() returns false.

chmod()
bool chmod(string path, int mode)
chmod attempts to change the permissions of path to mode. The mode is expected to be an octal number, such as 0755. An integer value such as 755 or a string value such as “u+x” will not work as expected. Returns true if the operation was successful and false if not.

Create A File Class
Now that we have an overview of many of the most used file functions in PHP, we can create a file class! Some of the file functions may seem a bit cryptic in their syntax, but by creating a file class, we can give our methods more meaningful names which can lead to more elegant and readable code. We’ll create a class that uses very simple static methods to wrap existing PHP file functions to make them easier to use. Place this code into a file called fileclass.php




class File {
    public static function put($file, $data, $append = false) {
    	if ( $append ) {
		return file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
		}
		return file_put_contents($file, $data, LOCK_EX); 
	}    
 
    public static function exists($file) {
    	return file_exists($file);
	}
    
    public static function read($file) {
        return readfile($file);
	}
	
	public static function size($file) {
	 	return filesize($file);
	}
	
	public static function name($file) {
	 	return pathinfo($file, PATHINFO_FILENAME);
	}
 
	public static function extension($file) {
	 	return pathinfo($file, PATHINFO_EXTENSION);
	}	
		
    public static function last_updated($file) {
		return filemtime($file);
	}	
	
    public static function get($file) {
		return static::exists($file)
		?  file_get_contents($file)
		:  false;
	}
    		
    public static function append($file, $data) {
		return static::put($file, $data, true);
	}
	
	public static function clear($file) {
		if ( static::exists($file) ) {
			$fp = fopen($file, 'w');
			fclose($fp);
		}
	}
    
    public static function delete($file) {
    	return unlink($file);
	}
    
}
Awesome! Now you can easily make use of this class like so:



include('fileclass.php');
 
File::put('newfile.txt', 'The first file created with our file class!');  //  create a new file
 
echo File::exists('newfile.txt');  // 1 or true
 
File::read('newfile.txt');  //  The first file created with our file class!
 
echo File::size('newfile.txt');  //  43
 
echo File::name('newfile.txt');  //  newfile
 
echo File::extension('newfile.txt');  //  txt
 
echo File::last_updated('newfile.txt');  //  1395865958
 
echo File::get('krumo/inKrumoDirectoryNow.txt');  //  yes, this file is in the krumo directory
 
File::append('newfile.txt', ' NEW DATA!');
 
File::read('newfile.txt');  //  The first file created with our file class! NEW DATA!
 
File::clear('newfile.txt');
 
File::read('newfile.txt');  //  file is now empty
 
File::delete('newfile.txt');  //  file is now deleted 





1=basename — Returns trailing name component of path
2=chgrp — Changes file group
3=chmod — Changes file mode
4=chown — Changes file owner
5=clearstatcache — Clears file status cache
6=copy — Copies file
7=delete — See unlink or unset
9=dirname — Returns a parent directorys path
10=disk_free_space — Returns available space on filesystem or disk partition
11=disk_total_space — Returns the total size of a filesystem or disk partition
12=diskfreespace — Alias of disk_free_space
13=fclose — Closes an open file pointer
14=feof — Tests for end-of-file on a file pointer
15=fflush — Flushes the output to a file
16=fgetc — Gets character from file pointer
18=fgetcsv — Gets line from file pointer and parse for CSV fields
19=fgets — Gets line from file pointer
20=fgetss — Gets line from file pointer and strip HTML tags
21=file_exists — Checks whether a file or directory exists
22=file_get_contents — Reads entire file into a string
23=file_put_contents — Write data to a file
24=file — Reads entire file into an array
25=fileatime — Gets last access time of file
26=filectime — Gets inode change time of file
27=filegroup — Gets file group
28=fileinode — Gets file inode
29=filemtime — Gets file modification time
30=fileowner — Gets file owner
31=fileperms — Gets file permissions
32=filesize — Gets file size
33=filetype — Gets file type
34=flock — Portable advisory file locking
35=fnmatch — Match filename against a pattern
36=fopen — Opens file or URL
37=fpassthru — Output all remaining data on a file pointer
38=fputcsv — Format line as CSV and write to file pointer
39=fputs — Alias of fwrite
40=fread — Binary-safe file read
41=fscanf — Parses input from a file according to a format
42=fseek — Seeks on a file pointer
43=fstat — Gets information about a file using an open file pointer
45=ftell — Returns the current position of the file read/write pointer
46=ftruncate — Truncates a file to a given length
47=fwrite — Binary-safe file write
48=glob — Find pathnames matching a pattern
49=is_dir — Tells whether the filename is a directory
50=is_executable — Tells whether the filename is executable
51=is_file — Tells whether the filename is a regular file
52=is_link — Tells whether the filename is a symbolic link
53=is_readable — Tells whether a file exists and is readable
54=is_uploaded_file — Tells whether the file was uploaded via HTTP POST
55=is_writable — Tells whether the filename is writable
56=is_writeable — Alias of is_writable
57=lchgrp — Changes group ownership of symlink
58=lchown — Changes user ownership of symlink
59=link — Create a hard link
60=linkinfo — Gets information about a link
61=lstat — Gives information about a file or symbolic link
62=mkdir — Makes directory
63=move_uploaded_file — Moves an uploaded file to a new location
64=parse_ini_file — Parse a configuration file
65=parse_ini_string — Parse a configuration string
66=pathinfo — Returns information about a file path
67=pclose — Closes process file pointer
68=popen — Opens process file pointer
69=readfile — Outputs a file
70=readlink — Returns the target of a symbolic link
71=realpath_cache_get — Get realpath cache entries
72=realpath_cache_size — Get realpath cache size
73=realpath — Returns canonicalized absolute pathname
74=rename — Renames a file or directory
75=rewind — Rewind the position of a file pointer
76=rmdir — Removes directory
77=set_file_buffer — Alias of stream_set_write_buffer
78=stat — Gives information about a file
79=symlink — Creates a symbolic link
80=tempnam — Create file with unique file name
81=tmpfile — Creates a temporary file
82=touch — Sets access and modification time of file
83=umask — Changes the current umask
84=unlink — Deletes a file
?>