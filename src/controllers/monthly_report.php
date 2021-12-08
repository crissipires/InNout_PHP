<?php

session_start();
requireValidSession();

loadModel('WorkingHours');

loadTemplateView('monthly_report');