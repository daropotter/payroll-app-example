INSERT INTO public.salary_policy (id, name, percentage, addition) VALUES (1, 'yearly_additional', null, 100.00);
INSERT INTO public.salary_policy (id, name, percentage, addition) VALUES (2, 'percentage_bonus', 10, DEFAULT);
INSERT INTO public.department (id, salary_policy_id, name) VALUES (1, 1, 'HR');
INSERT INTO public.department (id, salary_policy_id, name) VALUES (2, 2, 'Obsługa klienta');
INSERT INTO public.employee (id, department_id, first_name, last_name, base_salary, start_of_service) VALUES (1, 1, 'Adam', 'Kowalski', 1000.00, '2007-01-01');
INSERT INTO public.employee (id, department_id, first_name, last_name, base_salary, start_of_service) VALUES (2, 2, 'Ania', 'Nowak', 1100.00, '2017-01-01');
