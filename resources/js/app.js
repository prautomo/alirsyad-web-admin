/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');
require('./action');
require('./datatable');
/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// admin
import('./backoffice/components/ExternalUser');
import('./backoffice/components/StoryPath/Form');
// siswa
import('./frontoffice/components/Video/Detail');
import('./frontoffice/components/Modul/Detail');
import('./frontoffice/components/Nilai/List');
// guru
import('./guru/components/Dashboard/DetailProgressBelajar');
import('./guru/components/Progress/ListSiswa');
import('./guru/components/Progress/DetailSiswa');
import('./guru/components/Progress/DetailSimulasiPercobaan');