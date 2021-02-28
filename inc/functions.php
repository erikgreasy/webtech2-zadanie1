<?php


/**
 * Development function to print out unformated recursively variable
 */
function print_pre( $var ) {
    echo '<pre style="color: #000; background: #fff;">';
    print_r( $var );
    echo '</pre>';
}


/**
 * Creates array of files, with keys name, size and date of creation
 */
function create_files_array( $folder, $files ) {
    $files_arr = [];

    foreach( $files as $file ) {
        if( $file == '.' ) {
            continue;
        }
        
        $single_file = [];
        $single_file['name'] = $file;
        $single_file['size'] = filesize( $folder.$file );
        $single_file['date'] = filectime( $folder.$file );
        
        
        if( $file == '..' ) {
            $single_file['size'] = 0;
            $single_file['date'] = 0;
        }
        
        $files_arr[] = $single_file;
    }

    return $files_arr;
}


/**
 * Sorts array of arrays, by element key name size
 */
function sort_array_by_size( $array ) {
    usort( $array, function( $a, $b ) {
        if( $a[ 'size' ] == $b[ 'size' ] ) {
            return 0;
        }

        return ($a[ 'size' ] < $b[ 'size' ]) ? -1 : 1;
    } );

    return $array;
}


/**
 * Sorts array of arrays, by element key name date
 */
function sort_array_by_date( $array ) {
    usort( $array, function( $a, $b ) {
        if( $a[ 'date' ] == $b[ 'date' ] ) {
            return 0;
        }

        return ($a[ 'date' ] < $b[ 'date' ]) ? -1 : 1;
    } );

    return $array;
}