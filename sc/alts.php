<?



if ($r->type == 'hmi') {$alt =  '������ ��������� weintek, ������������ ������ weintek, hmi weintek '.$r->model;};

if ($r->type == 'panel_pc') {$alt =  '��������� ���������, ������������ ���������, ��������� weintek '.$r->model;

if ($r->model == 'cMT-iPC15') {$alt =  'cMT iPC15, ��������� ��������� weintek';	} else if ($r->model == 'cMT3151') {$alt =  'cmt3151, ��������� ��������� weintek';	};

};

if ($r->type == 'open_hmi') {$alt =  '������ ��������� weintek, ������������ ������ weintek, hmi weintek '.$r->model;};

if ($r->type == 'machine-tv-interface') {$alt  = 'weintek mtv 100';};

if ($r->type == 'cloud_hmi') {if ($r->model == 'cMT-SVR-100') {$alt =  'cMT SVR 100, �������� ���������';	} else if ($r->model == 'cMT-iV5') {$alt =  'cmt iv5, �������� ���������';};}; 