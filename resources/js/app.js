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
require('./backoffice/components/ExternalUser');
require('./backoffice/components/Dashboard');
require('./backoffice/components/ERaport');
require('./backoffice/components/StoryPath/Form');
require('./backoffice/pages/Soal');
// siswa
require('./frontoffice/components/Video/Detail');
require('./frontoffice/components/Modul/Detail');
require('./frontoffice/components/Nilai/List');
// guru
require('./guru/components/Dashboard/DetailProgressBelajar');
require('./guru/components/Progress/ListSiswa');
require('./guru/components/Progress/DetailSiswa');
require('./guru/components/Progress/DetailSimulasiPercobaan');