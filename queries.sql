-- project total wage
SELECT
    p.name AS 'project',
    SUM(a.hours * e.hourly) AS 'total_cost'
FROM
    projects AS p,
    assignments AS a,
    employees AS e
WHERE
    p.id = a.pid AND
    a.eid = e.iid
GROUP BY
    a.pid;

-- employee total wage
SELECT
    i.name AS 'employee',
    SUM(a.hours * e.hourly) AS 'total_wage'
FROM
    identities AS i,
    employees AS e,
    assignments AS a
WHERE
    i.id = e.iid AND
    e.iid = a.eid
GROUP BY
    i.id;

-- employee project hours
SELECT
    i.name AS 'employee',
    SUM(a.hours) AS 'total_hours'
FROM
    identities AS i,
    employees AS e,
    assignments AS a
WHERE
    i.id = e.iid AND
    e.iid = a.eid
GROUP BY
    a.eid;

-- employee project involvment
SELECT
    i.name AS 'employee',
    COUNT(a.eid) AS 'active_projects'
FROM
    identities AS i,
    employees AS e,
    assignments AS a
WHERE
    i.id = e.iid AND
    e.iid = a.eid
GROUP BY
    a.eid;

-- project progress by stage
SELECT
    p.stage AS 'stage',
    COUNT(p.stage) AS 'projects'
FROM
    projects AS p
GROUP BY
    p.stage;

-- number of direct subordinates
SELECT
    i.name AS 'employee',
    COUNT(e.iid) AS 'subordinates'
FROM
    identities AS i,
    employees AS e,
    employees AS sub
WHERE
    e.iid = i.id AND
    sub.supervisor = e.iid
GROUP BY
    e.iid;

-- department total cost
SELECT
    d.name AS 'department',
    SUM(a.hours * e.hourly) AS 'total_cost'
FROM
    departments AS d,
    projects AS p,
    assignments AS a,
    employees AS e
WHERE
    d.id = p.did AND
    p.id = a.pid AND
    a.eid = e.iid
GROUP BY
    d.id;
